@extends('admin.layouts.app')

@section('title', 'Page Text Editor')
@section('heading', 'Page Text Editor')

@section('content')
<div class="admin-card p-4">
    <p class="text-muted">Edit full page text/HTML for each language.</p>
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
            <tr>
                <th>Page</th>
                <th>English</th>
                <th>Japanese</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pages as $page)
                <tr>
                    <td><code>{{ $page }}</code></td>
                    <td><a class="btn btn-outline-primary btn-sm" href="{{ route('admin.pages.edit', ['locale' => 'en', 'page' => $page]) }}">Edit EN</a></td>
                    <td><a class="btn btn-outline-primary btn-sm" href="{{ route('admin.pages.edit', ['locale' => 'jp', 'page' => $page]) }}">Edit JP</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
