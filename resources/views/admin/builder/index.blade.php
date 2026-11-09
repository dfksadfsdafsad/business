@extends('admin.layouts.app')

@section('title', __('admin.visual_builder'))
@section('heading', __('admin.builder_list_title'))

@section('content')
<div class="admin-card p-4 mb-3">
    <form method="GET" class="row g-3 align-items-end">
        <div class="col-md-4">
            <label class="form-label">Slug</label>
            <input class="form-control" type="text" name="slug" value="{{ $filters['slug'] }}" placeholder="about, service, home-3">
        </div>
        <div class="col-md-3">
            <label class="form-label">Locale</label>
            <select class="form-select" name="locale">
                <option value="">All</option>
                @foreach($locales as $locale)
                    <option value="{{ $locale }}" @selected($filters['locale'] === $locale)>{{ strtoupper($locale) }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label">Status</label>
            <select class="form-select" name="status">
                <option value="">All</option>
                <option value="draft" @selected($filters['status'] === 'draft')>Draft</option>
                <option value="published" @selected($filters['status'] === 'published')>Published</option>
            </select>
        </div>
        <div class="col-md-2 d-grid">
            <button class="btn btn-primary" type="submit">Filter</button>
        </div>
    </form>
</div>

<div class="admin-card p-4">
    <h2 class="h6">All Pages</h2>
    <div class="table-responsive">
        <table class="table table-sm align-middle">
            <thead>
            <tr>
                <th>Page</th>
                <th>EN</th>
                <th>JP</th>
                <th>Saved</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pages as $slug)
                @php
                    $recordEn = $records->first(fn ($r) => $r->slug === $slug && $r->locale === 'en');
                    $recordJp = $records->first(fn ($r) => $r->slug === $slug && $r->locale === 'jp');
                @endphp
                <tr>
                    <td><code>{{ $slug }}</code></td>
                    <td><a class="btn btn-outline-primary btn-sm" href="{{ route('admin.builder.edit', ['locale' => 'en', 'page' => $slug]) }}">{{ __('admin.builder_open') }} EN</a></td>
                    <td><a class="btn btn-outline-primary btn-sm" href="{{ route('admin.builder.edit', ['locale' => 'jp', 'page' => $slug]) }}">{{ __('admin.builder_open') }} JP</a></td>
                    <td>
                        @if($recordEn || $recordJp)
                            Yes
                        @else
                            No
                        @endif
                    </td>
                    <td>
                        EN: {{ $recordEn?->status ?? '-' }} / JP: {{ $recordJp?->status ?? '-' }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
