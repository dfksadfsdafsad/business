<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ImageManagerController extends Controller
{
    public function index(string $page): View
    {
        abort_unless(array_key_exists($page, config('site.pages', [])), 404);

        $relativeDir = $this->directoryForPage($page);
        $absoluteDir = public_path('assets/images/'.$relativeDir);

        if (!File::exists($absoluteDir)) {
            File::makeDirectory($absoluteDir, 0755, true);
        }

        $files = collect(File::files($absoluteDir))
            ->map(function ($file) use ($relativeDir) {
                [$width, $height] = @getimagesize($file->getPathname()) ?: [null, null];

                return [
                    'name' => $file->getFilename(),
                    'url' => '/assets/images/'.$relativeDir.'/'.$file->getFilename(),
                    'size_kb' => (int) ceil($file->getSize() / 1024),
                    'width' => $width,
                    'height' => $height,
                ];
            })
            ->sortBy('name')
            ->values()
            ->all();

        return view('admin.images.index', [
            'page' => $page,
            'directory' => $relativeDir,
            'files' => $files,
            'pages' => array_keys(config('site.pages', [])),
        ]);
    }

    public function upload(Request $request, string $page): RedirectResponse
    {
        abort_unless(array_key_exists($page, config('site.pages', [])), 404);

        $validated = $request->validate([
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:10240'],
            'filename' => ['nullable', 'string', 'max:100'],
            'max_width' => ['nullable', 'integer', 'min:200', 'max:4000'],
            'max_height' => ['nullable', 'integer', 'min:200', 'max:4000'],
        ]);

        $relativeDir = $this->directoryForPage($page);
        $absoluteDir = public_path('assets/images/'.$relativeDir);

        if (!File::exists($absoluteDir)) {
            File::makeDirectory($absoluteDir, 0755, true);
        }

        $image = $validated['image'];
        $ext = $image->getClientOriginalExtension();

        $filename = $validated['filename'] ?? pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
        $filename = preg_replace('/[^a-zA-Z0-9-_]/', '-', $filename) ?: 'upload-'.time();
        $targetName = $filename.'.'.$ext;

        $maxWidth = (int) ($validated['max_width'] ?? 1920);
        $maxHeight = (int) ($validated['max_height'] ?? 1920);
        $this->saveResizedImage($image, $absoluteDir.'/'.$targetName, $maxWidth, $maxHeight);

        return back()->with('status', 'Image uploaded successfully.');
    }

    public function replace(Request $request, string $page, string $filename): RedirectResponse
    {
        abort_unless(array_key_exists($page, config('site.pages', [])), 404);

        $validated = $request->validate([
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:10240'],
            'max_width' => ['nullable', 'integer', 'min:200', 'max:4000'],
            'max_height' => ['nullable', 'integer', 'min:200', 'max:4000'],
        ]);

        $relativeDir = $this->directoryForPage($page);
        $absoluteDir = public_path('assets/images/'.$relativeDir);
        $safeName = basename($filename);
        $targetPath = $absoluteDir.'/'.$safeName;

        if (!File::exists($targetPath)) {
            return back()->withErrors(['image' => 'Target image does not exist.']);
        }

        $maxWidth = (int) ($validated['max_width'] ?? 1920);
        $maxHeight = (int) ($validated['max_height'] ?? 1920);
        $this->saveResizedImage($validated['image'], $targetPath, $maxWidth, $maxHeight);

        return back()->with('status', 'Image replaced and resized successfully. Frontend uses this file path, so changes are live immediately.');
    }

    public function destroy(string $page, string $filename): RedirectResponse
    {
        abort_unless(array_key_exists($page, config('site.pages', [])), 404);

        $relativeDir = $this->directoryForPage($page);
        $safeName = basename($filename);
        $path = public_path('assets/images/'.$relativeDir.'/'.$safeName);

        if (File::exists($path)) {
            File::delete($path);
        }

        return back()->with('status', 'Image deleted successfully.');
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

    private function saveResizedImage(UploadedFile $imageFile, string $targetPath, int $maxWidth, int $maxHeight): void
    {
        $maxWidth = max(200, min(4000, $maxWidth));
        $maxHeight = max(200, min(4000, $maxHeight));

        $manager = new ImageManager(new Driver());
        $image = $manager->read($imageFile->getRealPath());
        $image->scaleDown(width: $maxWidth, height: $maxHeight);

        $extension = strtolower(pathinfo($targetPath, PATHINFO_EXTENSION));

        if (in_array($extension, ['jpg', 'jpeg'], true)) {
            $image->toJpeg(85)->save($targetPath);
            return;
        }

        if ($extension === 'png') {
            $image->toPng()->save($targetPath);
            return;
        }

        if ($extension === 'webp') {
            $image->toWebp(85)->save($targetPath);
            return;
        }

        if ($extension === 'gif') {
            $image->toGif()->save($targetPath);
            return;
        }

        $image->toJpeg(85)->save($targetPath);
    }
}
