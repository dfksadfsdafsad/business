@extends('admin.layouts.app')

@section('title', __('admin.blog_list'))
@section('heading', __('admin.blog_list'))

@section('content')
<div class="admin-card p-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="h6 mb-0">{{ __('admin.blog_list') }}</h2>
        <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary btn-sm">{{ __('admin.blog_create') }}</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('admin.blog_title') }}</th>
                    <th>{{ __('admin.blog_slug') }}</th>
                    <th>{{ __('admin.blog_published_at') }}</th>
                    <th>{{ __('admin.blog_actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>
                            <div class="fw-semibold">{{ $post->title }}</div>
                            <small class="text-muted">{{ $post->is_published ? 'Published' : 'Draft' }}</small>
                        </td>
                        <td><code>{{ $post->slug }}</code></td>
                        <td>{{ $post->published_at?->format('Y-m-d H:i') ?? '-' }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.blogs.edit', $post) }}" class="btn btn-outline-primary btn-sm">{{ __('admin.blog_edit') }}</a>
                                <form method="POST" action="{{ route('admin.blogs.destroy', $post) }}" onsubmit="return confirm('{{ __('admin.blog_delete_confirm') }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">{{ __('admin.blog_empty') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pt-2">
        {{ $posts->links() }}
    </div>
</div>
@endsection
