@extends('admin.layouts.app')

@section('title', __('admin.blog_edit'))
@section('heading', __('admin.blog_edit'))

@section('content')
<div class="admin-card p-3">
    <form method="POST" action="{{ route('admin.blogs.update', $post) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.blogs._form')
    </form>
</div>
@endsection
