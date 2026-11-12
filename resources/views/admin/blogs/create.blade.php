@extends('admin.layouts.app')

@section('title', __('admin.blog_create'))
@section('heading', __('admin.blog_create'))

@section('content')
<div class="admin-card p-3">
    <form method="POST" action="{{ route('admin.blogs.store') }}" enctype="multipart/form-data">
        @csrf
        @include('admin.blogs._form')
    </form>
</div>
@endsection
