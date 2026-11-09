@extends('admin.layouts.app')

@section('title', 'Admin Account')
@section('heading', 'Admin Account Settings')

@section('content')
<div class="admin-card p-4">
    <form method="POST" action="{{ route('admin.profile.update') }}" class="row g-3">
        @csrf

        <div class="col-md-6">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" name="name" value="{{ old('name', auth()->user()->name) }}" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="{{ old('email', auth()->user()->email) }}" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">New Password (optional)</label>
            <input type="password" class="form-control" name="password">
        </div>

        <div class="col-md-6">
            <label class="form-label">Confirm New Password</label>
            <input type="password" class="form-control" name="password_confirmation">
        </div>

        <div class="col-md-6">
            <label class="form-label">Current Password (required to change password)</label>
            <input type="password" class="form-control" name="current_password">
        </div>

        <div class="col-12">
            <button class="btn btn-success" type="submit">Update Account</button>
        </div>
    </form>
</div>
@endsection
