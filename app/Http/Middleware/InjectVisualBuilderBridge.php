<?php

namespace App\Http\Middleware;

use App\Models\PageContent;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InjectVisualBuilderBridge
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (!$this->isHtmlResponse($response)) {
            return $response;
        }

        [$locale, $slug] = $this->resolveLocaleAndSlug($request);
        if (!$locale || !$slug) {
            return $response;
        }

        $content = (string) $response->getContent();

        if ($request->boolean('__builder') && $request->user()?->is_admin) {
            $payloadUrl = route('admin.builder.payload', ['locale' => $locale, 'page' => $slug]);
            $bridgeScript = $this->builderBridgeScript($payloadUrl);
            $content = $this->injectBeforeBodyEnd($content, $bridgeScript);
            $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
            $response->setContent($content);
            return $response;
        }

        $record = PageContent::query()
            ->where('slug', $slug)
            ->where('locale', $locale)
            ->where('status', 'published')
            ->first();

        $published = (array) ($record?->published_content ?? []);
        if (($published['kind'] ?? null) !== 'dom_overrides') {
            return $response;
        }

        $overrides = (array) ($published['overrides'] ?? []);
        if (count($overrides) === 0) {
            return $response;
        }

        $script = $this->applyOverridesScript($overrides);
        $content = $this->injectBeforeBodyEnd($content, $script);
        $response->setContent($content);

        return $response;
    }

    private function isHtmlResponse(Response $response): bool
    {
        $contentType = (string) $response->headers->get('Content-Type', '');
        return str_contains(strtolower($contentType), 'text/html');
    }

    private function resolveLocaleAndSlug(Request $request): array
    {
        $first = (string) $request->segment(1);
        $locale = in_array($first, ['en', 'jp'], true) ? $first : null;
        if (!$locale) {
            return [null, null];
        }

        $second = (string) $request->segment(2);
        $slug = $second !== '' ? $second : 'home-3';

        if (str_ends_with($slug, '.html')) {
            $slug = substr($slug, 0, -5);
        }

        $allowed = array_keys(config('site.pages', []));
        if (!in_array($slug, $allowed, true)) {
            return [null, null];
        }

        return [$locale, $slug];
    }

    private function injectBeforeBodyEnd(string $content, string $script): string
    {
        if (str_contains($content, '</body>')) {
            return str_replace('</body>', $script.'</body>', $content);
        }

        return $content.$script;
    }

    private function applyOverridesScript(array $overrides): string
    {
        $json = json_encode($overrides, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        return "<script>(function(){const ov={$json}||[];const q=(p)=>{try{return document.querySelector(p);}catch(e){return null;}};const apply=()=>{ov.forEach((item)=>{const el=q(item.path);if(!el)return;if(typeof item.text==='string'){el.textContent=item.text;}if(item.attrs&&typeof item.attrs==='object'){Object.keys(item.attrs).forEach((k)=>{if(item.attrs[k]===null||item.attrs[k]===''){return;}el.setAttribute(k,item.attrs[k]);});}if(item.styles&&typeof item.styles==='object'){Object.keys(item.styles).forEach((k)=>{if(item.styles[k]===null||item.styles[k]===''){return;}el.style.setProperty(k,item.styles[k]);});}});};apply();window.addEventListener('load',()=>{apply();setTimeout(apply,500);});})();</script>";
    }

    private function builderBridgeScript(string $payloadUrl): string
    {
        $js = <<<'JS'
<script>
(function () {
    window.__builderBridgeLoaded = true;
    const payloadUrl = '__PAYLOAD_URL__';
    const ORIG = window.location.origin;
    const editable = 'h1,h2,h3,h4,h5,h6,p,span,li,a,button,label,strong,em,small';
    const styleKeys = ['color', 'background-color', 'font-size', 'font-weight', 'text-align', 'margin', 'padding', 'border-radius'];
    let selected = null;
    let overrides = {};

    const cssPath = (el) => {
        if (!(el instanceof Element)) return '';
        if (el.id) return '#' + el.id;
        const parts = [];
        while (el && el.nodeType === 1 && el.tagName.toLowerCase() !== 'html') {
            let i = 1;
            let sib = el;
            while ((sib = sib.previousElementSibling) != null) {
                if (sib.tagName === el.tagName) i++;
            }
            parts.unshift(el.tagName.toLowerCase() + ':nth-of-type(' + i + ')');
            el = el.parentElement;
        }
        return parts.join(' > ');
    };

    const pick = (el) => {
        if (!el) return null;
        if (el.matches('img')) return el;
        return el.closest(editable);
    };

    const clearSelection = () => {
        document.querySelectorAll('[data-builder-selected="1"]').forEach((node) => {
            node.removeAttribute('data-builder-selected');
            node.style.outline = '';
        });
    };

    const ensureOverride = (path) => {
        if (!overrides[path]) {
            overrides[path] = { path, text: null, attrs: {}, styles: {} };
        }
        return overrides[path];
    };

    const applyOverride = (item) => {
        if (!item || !item.path) return;
        let el = null;
        try {
            el = document.querySelector(item.path);
        } catch (e) {
            el = null;
        }
        if (!el) return;

        if (typeof item.text === 'string' && !el.matches('img')) {
            el.textContent = item.text;
        }
        if (item.attrs && typeof item.attrs === 'object') {
            Object.keys(item.attrs).forEach((k) => {
                if (item.attrs[k] !== null && item.attrs[k] !== '') {
                    el.setAttribute(k, item.attrs[k]);
                }
            });
        }
        if (item.styles && typeof item.styles === 'object') {
            Object.keys(item.styles).forEach((k) => {
                if (item.styles[k] !== null && item.styles[k] !== '') {
                    el.style.setProperty(k, item.styles[k]);
                }
            });
        }
    };

    const collectCurrent = (el) => {
        const computed = window.getComputedStyle(el);
        const styles = {};
        styleKeys.forEach((k) => {
            styles[k] = computed.getPropertyValue(k) || '';
        });

        return {
            path: cssPath(el),
            tag: el.tagName.toLowerCase(),
            text: el.matches('img') ? null : (el.textContent || ''),
            attrs: {
                href: el.getAttribute('href') || '',
                src: el.getAttribute('src') || '',
                alt: el.getAttribute('alt') || '',
            },
            styles,
        };
    };

    document.addEventListener('click', (event) => {
        if (!window.parent || window.parent === window) return;
        const target = pick(event.target);
        if (!target) return;

        event.preventDefault();
        event.stopPropagation();

        clearSelection();
        selected = target;
        selected.setAttribute('data-builder-selected', '1');
        selected.style.outline = '2px solid #2563eb';

        const data = collectCurrent(selected);
        window.parent.postMessage({ type: 'builder:selected', payload: data }, ORIG);

        if (!target.matches('img')) {
            target.setAttribute('contenteditable', 'true');
            target.focus();
        }
    }, true);

    document.addEventListener('input', (event) => {
        if (!selected || event.target !== selected) return;
        const path = cssPath(selected);
        const ov = ensureOverride(path);
        ov.text = selected.textContent || '';
        window.parent.postMessage({ type: 'builder:changed' }, ORIG);
    }, true);

    window.addEventListener('message', (event) => {
        if (event.origin !== ORIG) return;
        const msg = event.data || {};

        if (msg.type === 'builder:apply' && msg.payload && selected) {
            const path = cssPath(selected);
            const ov = ensureOverride(path);

            if (typeof msg.payload.text === 'string' && !selected.matches('img')) {
                selected.textContent = msg.payload.text;
                ov.text = msg.payload.text;
            }

            if (msg.payload.attrs && typeof msg.payload.attrs === 'object') {
                Object.keys(msg.payload.attrs).forEach((k) => {
                    const v = msg.payload.attrs[k];
                    if (typeof v === 'string') {
                        selected.setAttribute(k, v);
                        ov.attrs[k] = v;
                    }
                });
            }

            if (msg.payload.styles && typeof msg.payload.styles === 'object') {
                Object.keys(msg.payload.styles).forEach((k) => {
                    const v = msg.payload.styles[k];
                    if (typeof v === 'string') {
                        selected.style.setProperty(k, v);
                        ov.styles[k] = v;
                    }
                });
            }

            window.parent.postMessage({ type: 'builder:changed' }, ORIG);
        }

        if (msg.type === 'builder:get-state') {
            window.parent.postMessage({ type: 'builder:state', payload: { overrides: Object.values(overrides) } }, ORIG);
        }

        if (msg.type === 'builder:apply-media' && msg.payload && selected) {
            const path = cssPath(selected);
            const ov = ensureOverride(path);
            if (selected.matches('img')) {
                selected.setAttribute('src', msg.payload.url || '');
                ov.attrs.src = msg.payload.url || '';
            } else {
                selected.style.setProperty('background-image', 'url(' + (msg.payload.url || '') + ')');
                ov.styles['background-image'] = 'url(' + (msg.payload.url || '') + ')';
            }
            window.parent.postMessage({ type: 'builder:changed' }, ORIG);
        }
    });

    const applyAllOverrides = () => {
        Object.values(overrides).forEach((item) => applyOverride(item));
    };

    fetch(payloadUrl + '?mode=draft', { headers: { 'Accept': 'application/json' } })
        .then((res) => res.ok ? res.json() : null)
        .then((data) => {
            const items = (data && data.payload && Array.isArray(data.payload.overrides)) ? data.payload.overrides : [];
            items.forEach((it) => {
                if (!it || !it.path) return;
                overrides[it.path] = {
                    path: it.path,
                    text: typeof it.text === 'string' ? it.text : null,
                    attrs: it.attrs && typeof it.attrs === 'object' ? it.attrs : {},
                    styles: it.styles && typeof it.styles === 'object' ? it.styles : {},
                };
                applyOverride(overrides[it.path]);
            });
            applyAllOverrides();
            window.addEventListener('load', () => { applyAllOverrides(); setTimeout(applyAllOverrides, 500); });
            window.parent.postMessage({ type: 'builder:ready' }, ORIG);
        })
        .catch(() => {
            window.parent.postMessage({ type: 'builder:ready' }, ORIG);
        });
})();
</script>
JS;

        return str_replace('__PAYLOAD_URL__', addslashes($payloadUrl), $js);
    }
}
