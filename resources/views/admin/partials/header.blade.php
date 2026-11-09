<nav class="col-md-2 d-none d-md-block sidebar py-4 px-3">
    <a href="{{ route('admin.dashboard') }}" class="d-block fs-5 fw-bold mb-4">{{ __('admin.dashboard') }}</a>

    <ul class="nav flex-column gap-2">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">{{ __('admin.dashboard') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}" href="{{ route('admin.settings.edit') }}">{{ __('admin.website_settings') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.pages.*') ? 'active' : '' }}" href="{{ route('admin.pages.index') }}">{{ __('admin.page_text_editor') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.images.*') ? 'active' : '' }}" href="{{ route('admin.images.index', ['page' => 'about']) }}">{{ __('admin.image_manager') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.builder.*') ? 'active' : '' }}" href="{{ route('admin.builder.index') }}">{{ __('admin.visual_builder') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}" href="{{ route('admin.profile.edit') }}">{{ __('admin.admin_account') }}</a>
        </li>
    </ul>
</nav>
