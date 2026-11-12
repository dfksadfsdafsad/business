<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        $posts = BlogPost::query()
            ->latest('id')
            ->paginate(12);

        return view('admin.blogs.index', compact('posts'));
    }

    public function create(): View
    {
        return view('admin.blogs.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatePayload($request);
        $data['author_id'] = $request->user()?->id;

        $uploadedPath = $this->handleFeaturedImageUpload($request);
        if ($uploadedPath !== null) {
            $data['featured_image'] = $uploadedPath;
        }

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        if ($data['is_published'] && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        BlogPost::create($data);

        return redirect()->route('admin.blogs.index')->with('status', __('admin.blog_saved'));
    }

    public function edit(BlogPost $blog): View
    {
        return view('admin.blogs.edit', ['post' => $blog]);
    }

    public function update(Request $request, BlogPost $blog): RedirectResponse
    {
        $data = $this->validatePayload($request, $blog->id);

        $uploadedPath = $this->handleFeaturedImageUpload($request);
        if ($uploadedPath !== null) {
            $data['featured_image'] = $uploadedPath;
        }

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        if ($data['is_published'] && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        if (! $data['is_published']) {
            $data['published_at'] = null;
        }

        $blog->update($data);

        return redirect()->route('admin.blogs.index')->with('status', __('admin.blog_updated'));
    }

    public function destroy(BlogPost $blog): RedirectResponse
    {
        $blog->delete();

        return redirect()->route('admin.blogs.index')->with('status', __('admin.blog_deleted'));
    }

    private function validatePayload(Request $request, ?int $ignoreId = null): array
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('blog_posts', 'slug')->ignore($ignoreId),
            ],
            'excerpt' => ['nullable', 'string', 'max:1000'],
            'content' => ['required', 'string'],
            'featured_image' => ['nullable', 'string', 'max:2048'],
            'featured_image_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:4096'],
            'published_at' => ['nullable', 'date'],
        ]);

        $validated['is_published'] = $request->boolean('is_published');

        return $validated;
    }

    private function handleFeaturedImageUpload(Request $request): ?string
    {
        if (! $request->hasFile('featured_image_file')) {
            return null;
        }

        $file = $request->file('featured_image_file');
        if ($file === null || ! $file->isValid()) {
            return null;
        }

        $directory = public_path('uploads/blogs');
        File::ensureDirectoryExists($directory);

        $filename = now()->format('YmdHis').'-'.Str::random(12).'.'.$file->getClientOriginalExtension();
        $file->move($directory, $filename);

        return '/uploads/blogs/'.$filename;
    }
}
