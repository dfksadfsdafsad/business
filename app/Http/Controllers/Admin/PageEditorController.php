<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class PageEditorController extends Controller
{
    public function index(): View
    {
        return view('admin.pages.index', [
            'pages' => array_keys(config('site.pages', [])),
        ]);
    }

    public function edit(string $locale, string $page): View
    {
        abort_unless(in_array($locale, ['en', 'jp'], true), 404);
        abort_unless(array_key_exists($page, config('site.pages', [])), 404);

        $path = $this->resolvePagePath($locale, $page);
        $content = File::exists($path) ? File::get($path) : '';
        $sectionData = $this->extractSections($content);

        return view('admin.pages.edit', [
            'locale' => $locale,
            'page' => $page,
            'path' => $path,
            'content' => $content,
            'sections' => $sectionData['sections'],
        ]);
    }

    public function update(Request $request, string $locale, string $page): RedirectResponse
    {
        abort_unless(in_array($locale, ['en', 'jp'], true), 404);
        abort_unless(array_key_exists($page, config('site.pages', [])), 404);

        $validated = $request->validate([
            'content' => ['required', 'string'],
        ]);

        $path = $this->resolvePagePath($locale, $page);

        if (!File::exists(dirname($path))) {
            File::makeDirectory(dirname($path), 0755, true);
        }

        File::put($path, $validated['content']);

        return back()->with('status', 'Page content updated successfully.');
    }

    public function updateSections(Request $request, string $locale, string $page): RedirectResponse
    {
        abort_unless(in_array($locale, ['en', 'jp'], true), 404);
        abort_unless(array_key_exists($page, config('site.pages', [])), 404);

        $validated = $request->validate([
            'sections_payload' => ['required', 'string'],
        ]);

        $decoded = json_decode($validated['sections_payload'], true);
        if (!is_array($decoded)) {
            return back()->withErrors(['sections_payload' => 'Invalid section payload JSON.']);
        }

        $sections = [];
        foreach ($decoded as $item) {
            if (!is_array($item)) {
                continue;
            }

            $html = trim((string) ($item['html'] ?? ''));
            if ($html !== '') {
                $sections[] = $html;
            }
        }

        $path = $this->resolvePagePath($locale, $page);
        $content = File::exists($path) ? File::get($path) : '';
        $sectionData = $this->extractSections($content);

        if (!$sectionData['has_sections']) {
            return back()->withErrors(['sections_payload' => 'This page has no detectable <section> blocks. Use full source editor instead.']);
        }

        $newContent = $sectionData['prefix'];
        if (count($sections) > 0) {
            $newContent .= "\n".implode("\n\n", $sections)."\n";
        }
        $newContent .= $sectionData['suffix'];

        File::put($path, $newContent);

        return back()->with('status', 'Page sections updated successfully. Frontend reflects changes immediately.');
    }

    private function resolvePagePath(string $locale, string $page): string
    {
        $base = resource_path('views/pages');

        if ($locale === 'jp') {
            return $base.'/jp/'.$page.'.blade.php';
        }

        return $base.'/'.$page.'.blade.php';
    }

    private function extractSections(string $content): array
    {
        $pattern = '/<section\\b[^>]*>.*?<\\/section>/is';
        preg_match_all($pattern, $content, $matches, PREG_OFFSET_CAPTURE);

        $items = $matches[0] ?? [];
        if (count($items) === 0) {
            return [
                'has_sections' => false,
                'prefix' => $content,
                'suffix' => '',
                'sections' => [],
            ];
        }

        $firstOffset = $items[0][1];
        $lastItem = $items[count($items) - 1];
        $lastHtml = $lastItem[0];
        $lastOffset = $lastItem[1];
        $lastEnd = $lastOffset + strlen($lastHtml);

        $sections = [];
        foreach ($items as $index => $item) {
            $html = $item[0];
            $title = $this->sectionTitle($html, $index + 1);
            $sections[] = [
                'id' => 'section-'.$index,
                'title' => $title,
                'html' => $html,
            ];
        }

        return [
            'has_sections' => true,
            'prefix' => substr($content, 0, $firstOffset),
            'suffix' => substr($content, $lastEnd),
            'sections' => $sections,
        ];
    }

    private function sectionTitle(string $html, int $fallbackIndex): string
    {
        if (preg_match('/id=["\']([^"\']+)["\']/i', $html, $idMatch)) {
            return 'Section: #'.$idMatch[1];
        }

        if (preg_match('/class=["\']([^"\']+)["\']/i', $html, $classMatch)) {
            $class = trim((string) $classMatch[1]);
            if ($class !== '') {
                $firstClass = explode(' ', $class)[0];
                return 'Section: .'.$firstClass;
            }
        }

        return 'Section '.$fallbackIndex;
    }
}
