<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageContent;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class VisualPageBuilderController extends Controller
{
    public function index(Request $request): View
    {
        $pages = array_keys(config('site.pages', []));
        $locales = ['en', 'jp'];

        $filterSlug = trim((string) $request->query('slug', ''));
        $filterLocale = trim((string) $request->query('locale', ''));
        $filterStatus = trim((string) $request->query('status', ''));

        $records = PageContent::query()
            ->when($filterSlug !== '', fn ($q) => $q->where('slug', 'like', '%'.$filterSlug.'%'))
            ->when(in_array($filterLocale, $locales, true), fn ($q) => $q->where('locale', $filterLocale))
            ->when(in_array($filterStatus, ['draft', 'published'], true), fn ($q) => $q->where('status', $filterStatus))
            ->orderBy('slug')
            ->orderBy('locale')
            ->get();

        return view('admin.builder.index', [
            'pages' => $pages,
            'locales' => $locales,
            'records' => $records,
            'filters' => [
                'slug' => $filterSlug,
                'locale' => $filterLocale,
                'status' => $filterStatus,
            ],
        ]);
    }

    public function edit(string $locale, string $page): View
    {
        $this->assertValidLocaleAndPage($locale, $page);

        $record = PageContent::query()->firstOrCreate(
            ['slug' => $page, 'locale' => $locale],
            [
                'title' => Str::headline($page).' ('.strtoupper($locale).')',
                'meta' => ['slug' => $page, 'locale' => $locale],
                'draft_content' => ['kind' => 'dom_overrides', 'overrides' => []],
                'status' => 'draft',
            ]
        );

        if (!is_array($record->draft_content)) {
            $record->draft_content = ['kind' => 'dom_overrides', 'overrides' => []];
            $record->save();
        }

        $publicPath = '/'.$locale.($page === 'home-3' ? '' : '/'.$page);
        $iframeUrl = url($publicPath.'?__builder=1&page='.$page.'&locale='.$locale);

        return view('admin.builder.edit', [
            'page' => $page,
            'locale' => $locale,
            'record' => $record,
            'iframeUrl' => $iframeUrl,
            'translations' => [
                'unsaved' => __('admin.builder_unsaved'),
                'saved' => __('admin.builder_saved'),
                'published' => __('admin.builder_published'),
                'validation_failed' => __('admin.builder_validation_failed'),
                'unsaved_badge' => __('admin.builder_unsaved_badge'),
                'saved_badge' => __('admin.builder_saved_badge'),
            ],
            'payloadApi' => route('admin.builder.payload', ['locale' => $locale, 'page' => $page]),
            'mediaApi' => route('admin.builder.media.index', ['page' => $page]),
            'mediaUploadApi' => route('admin.builder.media.upload', ['page' => $page]),
            'saveDraftApi' => route('admin.builder.save-draft', ['locale' => $locale, 'page' => $page]),
            'publishApi' => route('admin.builder.publish', ['locale' => $locale, 'page' => $page]),
        ]);
    }

    public function payload(Request $request, string $locale, string $page): JsonResponse
    {
        $this->assertValidLocaleAndPage($locale, $page);

        $mode = $request->query('mode', 'draft');
        if (!in_array($mode, ['draft', 'published'], true)) {
            $mode = 'draft';
        }

        $record = PageContent::query()
            ->where('slug', $page)
            ->where('locale', $locale)
            ->first();

        $content = $mode === 'published'
            ? (array) ($record?->published_content ?? [])
            : (array) ($record?->draft_content ?? []);

        return response()->json([
            'ok' => true,
            'mode' => $mode,
            'title' => (string) ($record?->title ?? Str::headline($page)),
            'meta' => (array) ($record?->meta ?? []),
            'payload' => [
                'kind' => (string) ($content['kind'] ?? 'dom_overrides'),
                'overrides' => (array) ($content['overrides'] ?? []),
            ],
        ]);
    }

    public function saveDraft(Request $request, string $locale, string $page): JsonResponse
    {
        $this->assertValidLocaleAndPage($locale, $page);

        $payload = $this->validatePayload($request);

        DB::transaction(function () use ($payload, $locale, $page): void {
            $record = PageContent::query()->firstOrCreate(
                ['slug' => $page, 'locale' => $locale],
                ['title' => $payload['title']]
            );

            $record->title = $payload['title'];
            $record->meta = $payload['meta'];
            $record->draft_content = [
                'kind' => 'dom_overrides',
                'overrides' => $payload['overrides'],
            ];
            if ($record->status !== 'published') {
                $record->status = 'draft';
            }
            $record->save();
        });

        return response()->json([
            'ok' => true,
            'message' => __('admin.builder_saved'),
        ]);
    }

    public function publish(Request $request, string $locale, string $page): JsonResponse
    {
        $this->assertValidLocaleAndPage($locale, $page);

        $payload = $this->validatePayload($request);

        DB::transaction(function () use ($payload, $locale, $page): void {
            $record = PageContent::query()->firstOrCreate(
                ['slug' => $page, 'locale' => $locale],
                ['title' => $payload['title']]
            );

            $record->title = $payload['title'];
            $record->meta = $payload['meta'];
            $record->draft_content = [
                'kind' => 'dom_overrides',
                'overrides' => $payload['overrides'],
            ];
            $record->published_content = [
                'kind' => 'dom_overrides',
                'overrides' => $payload['overrides'],
            ];
            $record->status = 'published';
            $record->published_at = now();
            $record->save();
        });

        return response()->json([
            'ok' => true,
            'message' => __('admin.builder_published'),
        ]);
    }

    public function listMedia(string $page): JsonResponse
    {
        abort_unless(array_key_exists($page, config('site.pages', [])), 404);

        $assetsDir = public_path('assets/images/'.$this->directoryForPage($page));
        $assetsMedia = [];

        if (File::exists($assetsDir)) {
            $assetsMedia = collect(File::files($assetsDir))
                ->filter(fn ($f) => $this->isAllowedMediaExt($f->getExtension()))
                ->map(fn ($f) => [
                    'name' => $f->getFilename(),
                    'url' => '/assets/images/'.$this->directoryForPage($page).'/'.$f->getFilename(),
                    'source' => 'assets',
                ])
                ->values()
                ->all();
        }

        $uploadDisk = Storage::disk('public');
        $uploadFolder = 'builder/'.$page;
        $uploadMedia = [];

        if ($uploadDisk->exists($uploadFolder)) {
            $uploadMedia = collect($uploadDisk->files($uploadFolder))
                ->filter(fn ($path) => $this->isAllowedMediaExt(pathinfo($path, PATHINFO_EXTENSION)))
                ->map(fn ($path) => [
                    'name' => basename($path),
                    'url' => asset('storage/'.$path),
                    'source' => 'uploads',
                ])
                ->values()
                ->all();
        }

        return response()->json([
            'ok' => true,
            'items' => array_values(array_merge($assetsMedia, $uploadMedia)),
        ]);
    }

    public function uploadMedia(Request $request, string $page): JsonResponse
    {
        abort_unless(array_key_exists($page, config('site.pages', [])), 404);

        $validated = $request->validate([
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:10240'],
        ]);

        $image = $validated['image'];
        $name = Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME));
        $name = ($name !== '' ? $name : 'upload').'-'.time().'.'.$image->getClientOriginalExtension();

        $path = $image->storeAs('builder/'.$page, $name, 'public');

        return response()->json([
            'ok' => true,
            'message' => __('admin.media_uploaded'),
            'item' => [
                'name' => basename($path),
                'url' => asset('storage/'.$path),
                'source' => 'uploads',
            ],
        ]);
    }

    private function validatePayload(Request $request): array
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'meta' => ['nullable', 'array'],
            'meta.description' => ['nullable', 'string', 'max:500'],
            'overrides' => ['required', 'array', 'max:1000'],
            'overrides.*.path' => ['required', 'string', 'max:500'],
            'overrides.*.text' => ['nullable', 'string', 'max:4000'],
            'overrides.*.attrs' => ['nullable', 'array'],
            'overrides.*.styles' => ['nullable', 'array'],
        ]);

        $overrides = [];
        foreach ((array) $validated['overrides'] as $item) {
            $path = trim((string) ($item['path'] ?? ''));
            if ($path === '') {
                continue;
            }

            $attrs = is_array($item['attrs'] ?? null) ? $item['attrs'] : [];
            $styles = is_array($item['styles'] ?? null) ? $item['styles'] : [];

            $cleanAttrs = [];
            foreach (['href', 'src', 'alt'] as $key) {
                if (!array_key_exists($key, $attrs)) {
                    continue;
                }

                if ($key === 'href') {
                    $cleanAttrs[$key] = $this->sanitizeUrl((string) $attrs[$key]);
                    continue;
                }

                if ($key === 'src') {
                    $cleanAttrs[$key] = $this->sanitizeImageUrl((string) $attrs[$key]);
                    continue;
                }

                $cleanAttrs[$key] = strip_tags((string) $attrs[$key]);
            }

            $cleanStyles = [];
            foreach (['color', 'background-color', 'font-size', 'font-weight', 'text-align', 'margin', 'padding', 'border-radius'] as $styleKey) {
                if (!array_key_exists($styleKey, $styles)) {
                    continue;
                }

                $cleanStyles[$styleKey] = $this->sanitizeStyleValue($styleKey, (string) $styles[$styleKey]);
            }

            $overrides[] = [
                'path' => $path,
                'text' => array_key_exists('text', $item) ? strip_tags((string) $item['text']) : null,
                'attrs' => $cleanAttrs,
                'styles' => $cleanStyles,
            ];
        }

        return [
            'title' => strip_tags((string) $validated['title']),
            'meta' => [
                'description' => strip_tags((string) data_get($validated, 'meta.description', '')),
            ],
            'overrides' => $overrides,
        ];
    }

    private function sanitizeUrl(string $url): string
    {
        $url = trim($url);
        if ($url === '' || $url === '#') {
            return '#';
        }

        if (Str::startsWith($url, ['/'])) {
            return $url;
        }

        if (filter_var($url, FILTER_VALIDATE_URL)) {
            return $url;
        }

        return '#';
    }

    private function sanitizeImageUrl(string $url): string
    {
        $url = trim($url);
        if ($url === '') {
            return '';
        }

        if (Str::startsWith($url, ['/assets/images/', '/storage/'])) {
            return $url;
        }

        return '';
    }

    private function sanitizeStyleValue(string $key, string $value): string
    {
        $value = trim($value);

        if (in_array($key, ['color', 'background-color'], true)) {
            if (preg_match('/^#[0-9a-fA-F]{6}$/', $value)) {
                return strtolower($value);
            }

            return '#111827';
        }

        if ($key === 'text-align') {
            return in_array($value, ['left', 'center', 'right', 'justify'], true) ? $value : 'left';
        }

        if (in_array($key, ['font-size', 'margin', 'padding', 'border-radius'], true)) {
            if (preg_match('/^[0-9]{1,3}px$/', $value)) {
                return $value;
            }

            return '0px';
        }

        if ($key === 'font-weight') {
            return preg_match('/^(normal|bold|[1-9]00)$/', $value) ? $value : 'normal';
        }

        return '';
    }

    private function assertValidLocaleAndPage(string $locale, string $page): void
    {
        abort_unless(in_array($locale, ['en', 'jp'], true), 404);
        abort_unless(array_key_exists($page, config('site.pages', [])), 404);
    }

    private function isAllowedMediaExt(string $ext): bool
    {
        return in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif', 'webp'], true);
    }

    private function directoryForPage(string $page): string
    {
        $map = [
            'home-3' => 'hero',
            'about' => 'about',
            'contact' => 'contact',
            'faq' => 'faq',
            'gallery' => 'gallery',
            'pricing' => 'pricing',
            'project' => 'project',
            'project-details' => 'project',
            'service' => 'service',
            'service-details' => 'service',
            'team' => 'team',
            'team-details' => 'team',
            'blog-grid' => 'blog',
            'blog-list' => 'blog',
            'blog-details' => 'blog',
            '404' => 'error',
        ];

        return $map[$page] ?? 'images';
    }
}
