@php
    $isEdit = isset($post);
@endphp

<div class="row g-3">
    <div class="col-md-8">
        <label class="form-label" for="title">{{ __('admin.blog_title') }}</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title ?? '') }}" required>
    </div>

    <div class="col-md-4">
        <label class="form-label" for="slug">{{ __('admin.blog_slug') }}</label>
        <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $post->slug ?? '') }}" placeholder="auto-generated-if-empty">
    </div>

    <div class="col-12">
        <label class="form-label" for="featured_image">{{ __('admin.blog_featured_image') }}</label>
        <input type="text" class="form-control" id="featured_image" name="featured_image" value="{{ old('featured_image', $post->featured_image ?? '') }}" placeholder="https://... or /assets/images/...">
        <small class="text-muted">You can paste an image URL/path or upload a new image below.</small>
    </div>

    <div class="col-12">
        <label class="form-label" for="featured_image_file">{{ __('admin.blog_upload_image') }}</label>
        <input type="file" class="form-control" id="featured_image_file" name="featured_image_file" accept="image/*">
        @if(!empty($post?->featured_image))
            <div class="mt-2">
                <img src="{{ $post->featured_image }}" alt="Current featured image" style="max-width: 240px; border-radius: 8px; border: 1px solid #e5e7eb;">
            </div>
        @endif
    </div>

    <div class="col-12">
        <label class="form-label" for="excerpt">{{ __('admin.blog_excerpt') }}</label>
        <textarea class="form-control" id="excerpt" name="excerpt" rows="3">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
    </div>

    <div class="col-12">
        <label class="form-label" for="content">{{ __('admin.blog_content') }}</label>
        <textarea class="form-control" id="content" name="content" rows="14" required>{{ old('content', $post->content ?? '') }}</textarea>
    </div>

    <div class="col-md-4">
        <label class="form-label" for="published_at">{{ __('admin.blog_published_at') }}</label>
        <input
            type="datetime-local"
            class="form-control"
            id="published_at"
            name="published_at"
            value="{{ old('published_at', isset($post) && $post->published_at ? $post->published_at->format('Y-m-d\\TH:i') : '') }}"
        >
    </div>

    <div class="col-md-4 d-flex align-items-end">
        <div class="form-check">
            <input
                class="form-check-input"
                type="checkbox"
                value="1"
                id="is_published"
                name="is_published"
                @checked(old('is_published', $post->is_published ?? false))
            >
            <label class="form-check-label" for="is_published">
                {{ __('admin.blog_is_published') }}
            </label>
        </div>
    </div>

    <div class="col-12 d-flex gap-2 pt-2">
        <button type="submit" class="btn btn-primary">{{ $isEdit ? __('admin.blog_edit') : __('admin.blog_create') }}</button>
        <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-secondary">{{ __('admin.blog_back') }}</a>
    </div>
</div>
