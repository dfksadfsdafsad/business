@extends('admin.layouts.app')

@section('title', __('admin.dashboard'))
@section('heading', __('admin.dashboard'))

@section('content')
<div class="row g-3">
    <div class="col-md-4">
        <div class="admin-card p-3">
            <h2 class="h6">{{ __('admin.website_settings') }}</h2>
            <p class="text-muted mb-3">Update business name, contacts, social links, and business hours.</p>
            <a href="{{ route('admin.settings.edit') }}" class="btn btn-primary btn-sm">Open Settings</a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="admin-card p-3">
            <h2 class="h6">{{ __('admin.page_text_editor') }}</h2>
            <p class="text-muted mb-3">Edit full text/HTML for English and Japanese page files.</p>
            <a href="{{ route('admin.pages.index') }}" class="btn btn-primary btn-sm">Open Text Editor</a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="admin-card p-3">
            <h2 class="h6">{{ __('admin.image_manager') }}</h2>
            <p class="text-muted mb-3">Upload or delete page-specific images from one place.</p>
            <a href="{{ route('admin.images.index', ['page' => 'about']) }}" class="btn btn-primary btn-sm">Open Image Manager</a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="admin-card p-3">
            <h2 class="h6">{{ __('admin.visual_builder') }}</h2>
            <p class="text-muted mb-3">Create page layouts visually with draft/publish workflow.</p>
            <a href="{{ route('admin.builder.index') }}" class="btn btn-primary btn-sm">Open Builder</a>
        </div>
    </div>
</div>
@endsection
