<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Panel') | {{ config('business.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f5f7fb; }
        .sidebar { min-height: 100vh; background: #0d1b2a; }
        .sidebar a { color: #dbe8ff; text-decoration: none; }
        .sidebar a:hover, .sidebar a.active { color: #fff; }
        .topbar { background: #fff; border-bottom: 1px solid #e5e7eb; }
        .admin-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 10px; }
        .content-wrap { min-height: calc(100vh - 120px); }
    </style>
    @stack('styles')
</head>
<body>
<div class="container-fluid">
    <div class="row">
        @include('admin.partials.header')
        <main class="col-md-10 ms-sm-auto px-0">
            <div class="topbar px-4 py-3 d-flex justify-content-between align-items-center">
                <h1 class="h5 m-0">@yield('heading', 'Dashboard')</h1>
                <div>
                    <form method="POST" action="{{ route('admin.locale.update') }}" class="d-inline me-2">
                        @csrf
                        <select name="locale" class="form-select form-select-sm d-inline-block" style="width:auto;" onchange="this.form.submit()">
                            <option value="en" @selected(app()->getLocale() === 'en')>EN</option>
                            <option value="jp" @selected(app()->getLocale() === 'jp')>JP</option>
                        </select>
                    </form>
                    <span class="me-3 text-muted">{{ auth()->user()->email }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button class="btn btn-outline-danger btn-sm" type="submit">Logout</button>
                    </form>
                </div>
            </div>

            <div class="p-4 content-wrap">
                @if(session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>

            @include('admin.partials.footer')
        </main>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
