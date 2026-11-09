@extends('admin.layouts.app')

@section('title', __('admin.website_settings'))
@section('heading', __('admin.website_settings'))

@section('content')
<div class="admin-card p-4 mb-3">
    <div class="row g-3 align-items-end">
        <div class="col-md-6">
            <label class="form-label">{{ __('admin.settings_filter_label') }}</label>
            <input type="text" class="form-control" id="settingsFieldFilter" placeholder="{{ __('admin.settings_filter_placeholder') }}">
        </div>
        <div class="col-md-6">
            <form method="GET" class="row g-2 align-items-end">
                <div class="col-8">
                    <label class="form-label">{{ __('admin.settings_quick_pages') }}</label>
                    <input type="text" class="form-control" name="page_filter" value="{{ $pageFilter }}" placeholder="about, service, home-3">
                </div>
                <div class="col-4 d-grid">
                    <button type="submit" class="btn btn-outline-primary">Filter Pages</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="admin-card p-4 mb-3">
    <h2 class="h6 mb-3">{{ __('admin.settings_quick_pages') }}</h2>
    <div class="table-responsive">
        <table class="table table-sm align-middle mb-0">
            <thead>
            <tr>
                <th>Page</th>
                <th>Text Editor</th>
                <th>Image Manager</th>
                <th>Visual Builder</th>
            </tr>
            </thead>
            <tbody>
            @forelse($filteredPages as $slug)
                <tr>
                    <td><code>{{ $slug }}</code></td>
                    <td><a class="btn btn-outline-secondary btn-sm" href="{{ route('admin.pages.edit', ['locale' => 'en', 'page' => $slug]) }}">EN</a> <a class="btn btn-outline-secondary btn-sm" href="{{ route('admin.pages.edit', ['locale' => 'jp', 'page' => $slug]) }}">JP</a></td>
                    <td><a class="btn btn-outline-secondary btn-sm" href="{{ route('admin.images.index', ['page' => $slug]) }}">Open</a></td>
                    <td><a class="btn btn-outline-primary btn-sm" href="{{ route('admin.builder.edit', ['locale' => 'en', 'page' => $slug]) }}">EN</a> <a class="btn btn-outline-primary btn-sm" href="{{ route('admin.builder.edit', ['locale' => 'jp', 'page' => $slug]) }}">JP</a></td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-muted">No pages match this filter.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="admin-card p-4">
    <form method="POST" action="{{ route('admin.settings.update') }}" class="row g-3">
        @csrf
        <div class="col-md-6 setting-field" data-keywords="business name general">
            <label class="form-label">Business Name</label>
            <input type="text" class="form-control" name="name" value="{{ old('name', data_get($business, 'name')) }}" required>
        </div>

        <div class="col-md-6 setting-field" data-keywords="email primary contact">
            <label class="form-label">Primary Email</label>
            <input type="email" class="form-control" name="email_primary" value="{{ old('email_primary', data_get($business, 'email.primary')) }}" required>
        </div>

        <div class="col-md-6 setting-field" data-keywords="email support contact">
            <label class="form-label">Support Email</label>
            <input type="email" class="form-control" name="email_support" value="{{ old('email_support', data_get($business, 'email.support')) }}">
        </div>

        <div class="col-md-6 setting-field" data-keywords="phone raw contact">
            <label class="form-label">Phone Raw (for links)</label>
            <input type="text" class="form-control" name="phone_raw" value="{{ old('phone_raw', data_get($business, 'phone.raw')) }}" required>
        </div>

        <div class="col-md-6 setting-field" data-keywords="phone display contact">
            <label class="form-label">Phone Display</label>
            <input type="text" class="form-control" name="phone_display" value="{{ old('phone_display', data_get($business, 'phone.display')) }}" required>
        </div>

        <div class="col-md-12 setting-field" data-keywords="hours time business">
            <label class="form-label">Business Hours</label>
            <input type="text" class="form-control" name="hours" value="{{ old('hours', data_get($business, 'hours')) }}" required>
        </div>

        <div class="col-md-6 setting-field" data-keywords="social facebook url">
            <label class="form-label">Facebook URL</label>
            <input type="text" class="form-control" name="social_facebook" value="{{ old('social_facebook', data_get($business, 'social.facebook')) }}">
        </div>
        <div class="col-md-6 setting-field" data-keywords="social twitter x url">
            <label class="form-label">X / Twitter URL</label>
            <input type="text" class="form-control" name="social_x_twitter" value="{{ old('social_x_twitter', data_get($business, 'social.x_twitter')) }}">
        </div>
        <div class="col-md-6 setting-field" data-keywords="social linkedin url">
            <label class="form-label">LinkedIn URL</label>
            <input type="text" class="form-control" name="social_linkedin" value="{{ old('social_linkedin', data_get($business, 'social.linkedin')) }}">
        </div>
        <div class="col-md-6 setting-field" data-keywords="social pinterest url">
            <label class="form-label">Pinterest URL</label>
            <input type="text" class="form-control" name="social_pinterest" value="{{ old('social_pinterest', data_get($business, 'social.pinterest')) }}">
        </div>
        <div class="col-md-6 setting-field" data-keywords="social instagram url">
            <label class="form-label">Instagram URL</label>
            <input type="text" class="form-control" name="social_instagram" value="{{ old('social_instagram', data_get($business, 'social.instagram')) }}">
        </div>
        <div class="col-md-6 setting-field" data-keywords="social google plus url">
            <label class="form-label">Google Plus URL</label>
            <input type="text" class="form-control" name="social_google_plus" value="{{ old('social_google_plus', data_get($business, 'social.google_plus')) }}">
        </div>

        <div class="col-12"><hr></div>
        <div class="col-12 setting-field" data-keywords="smtp mail server config">
            <h3 class="h6 mb-2">SMTP Configuration</h3>
            <p class="text-muted mb-0">When enabled, frontend contact form messages are sent using this SMTP account.</p>
        </div>

        <div class="col-md-4 setting-field" data-keywords="smtp enable toggle">
            <label class="form-label">Enable SMTP</label>
            <select class="form-select" name="smtp_enabled">
                <option value="0" @selected(!old('smtp_enabled', $smtp['enabled'] ? '1' : '0'))>No</option>
                <option value="1" @selected(old('smtp_enabled', $smtp['enabled'] ? '1' : '0') === '1')>Yes</option>
            </select>
        </div>

        <div class="col-md-4 setting-field" data-keywords="smtp host mail server">
            <label class="form-label">SMTP Host</label>
            <input type="text" class="form-control" name="smtp_host" value="{{ old('smtp_host', $smtp['host']) }}" placeholder="smtp.gmail.com">
        </div>

        <div class="col-md-4 setting-field" data-keywords="smtp port mail server">
            <label class="form-label">SMTP Port</label>
            <input type="number" class="form-control" name="smtp_port" value="{{ old('smtp_port', $smtp['port']) }}" min="1" max="65535" placeholder="587">
        </div>

        <div class="col-md-4 setting-field" data-keywords="smtp username mail login">
            <label class="form-label">SMTP Username</label>
            <input type="text" class="form-control" name="smtp_username" value="{{ old('smtp_username', $smtp['username']) }}">
        </div>

        <div class="col-md-4 setting-field" data-keywords="smtp password mail login">
            <label class="form-label">SMTP Password</label>
            <input type="password" class="form-control" name="smtp_password" value="{{ old('smtp_password', $smtp['password']) }}">
        </div>

        <div class="col-md-4 setting-field" data-keywords="smtp encryption tls ssl">
            <label class="form-label">Encryption</label>
            <select class="form-select" name="smtp_encryption">
                <option value="" @selected(old('smtp_encryption', $smtp['encryption']) === '')>None</option>
                <option value="tls" @selected(old('smtp_encryption', $smtp['encryption']) === 'tls')>TLS</option>
                <option value="ssl" @selected(old('smtp_encryption', $smtp['encryption']) === 'ssl')>SSL</option>
            </select>
        </div>

        <div class="col-md-4 setting-field" data-keywords="smtp from address sender">
            <label class="form-label">From Email</label>
            <input type="email" class="form-control" name="smtp_from_address" value="{{ old('smtp_from_address', $smtp['from_address']) }}" placeholder="noreply@example.com">
        </div>

        <div class="col-md-4 setting-field" data-keywords="smtp from name sender">
            <label class="form-label">From Name</label>
            <input type="text" class="form-control" name="smtp_from_name" value="{{ old('smtp_from_name', $smtp['from_name']) }}" placeholder="{{ config('business.name') }}">
        </div>

        <div class="col-md-4 setting-field" data-keywords="smtp recipient to address">
            <label class="form-label">Contact Receiver Email</label>
            <input type="email" class="form-control" name="smtp_to_address" value="{{ old('smtp_to_address', $smtp['to_address']) }}" placeholder="contact@example.com">
        </div>

        <div class="col-12">
            <button class="btn btn-success" type="submit">{{ __('admin.save_settings') }}</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
(() => {
    const filterInput = document.getElementById('settingsFieldFilter');
    if (!filterInput) return;

    const fields = Array.from(document.querySelectorAll('.setting-field'));

    filterInput.addEventListener('input', () => {
        const query = filterInput.value.trim().toLowerCase();

        fields.forEach((field) => {
            const text = (field.getAttribute('data-keywords') || '').toLowerCase();
            field.style.display = query === '' || text.includes(query) ? '' : 'none';
        });
    });
})();
</script>
@endpush
