<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebsiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function edit(Request $request): View
    {
        $pageFilter = trim((string) $request->query('page_filter', ''));
        $allPages = array_keys(config('site.pages', []));
        $filteredPages = collect($allPages)
            ->filter(fn (string $slug) => $pageFilter === '' || str_contains(strtolower($slug), strtolower($pageFilter)))
            ->values()
            ->all();

        $settings = WebsiteSetting::allAsKeyValue();

        return view('admin.settings', [
            'business' => config('business'),
            'filteredPages' => $filteredPages,
            'pageFilter' => $pageFilter,
            'smtp' => [
                'enabled' => filter_var($settings['smtp.enabled'] ?? false, FILTER_VALIDATE_BOOLEAN),
                'host' => (string) ($settings['smtp.host'] ?? config('mail.mailers.smtp.host')),
                'port' => (string) ($settings['smtp.port'] ?? config('mail.mailers.smtp.port')),
                'username' => (string) ($settings['smtp.username'] ?? config('mail.mailers.smtp.username')),
                'password' => (string) ($settings['smtp.password'] ?? ''),
                'encryption' => (string) ($settings['smtp.encryption'] ?? ''),
                'from_address' => (string) ($settings['smtp.from_address'] ?? config('mail.from.address')),
                'from_name' => (string) ($settings['smtp.from_name'] ?? config('mail.from.name')),
                'to_address' => (string) ($settings['smtp.to_address'] ?? config('business.email.primary')),
            ],
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email_primary' => ['required', 'email', 'max:255'],
            'email_support' => ['nullable', 'email', 'max:255'],
            'phone_raw' => ['required', 'string', 'max:50'],
            'phone_display' => ['required', 'string', 'max:100'],
            'hours' => ['required', 'string', 'max:255'],
            'social_facebook' => ['nullable', 'string', 'max:255'],
            'social_x_twitter' => ['nullable', 'string', 'max:255'],
            'social_linkedin' => ['nullable', 'string', 'max:255'],
            'social_pinterest' => ['nullable', 'string', 'max:255'],
            'social_instagram' => ['nullable', 'string', 'max:255'],
            'social_google_plus' => ['nullable', 'string', 'max:255'],
            'smtp_enabled' => ['nullable', 'boolean'],
            'smtp_host' => ['nullable', 'string', 'max:255'],
            'smtp_port' => ['nullable', 'integer', 'min:1', 'max:65535'],
            'smtp_username' => ['nullable', 'string', 'max:255'],
            'smtp_password' => ['nullable', 'string', 'max:255'],
            'smtp_encryption' => ['nullable', 'in:tls,ssl'],
            'smtp_from_address' => ['nullable', 'email', 'max:255'],
            'smtp_from_name' => ['nullable', 'string', 'max:255'],
            'smtp_to_address' => ['nullable', 'email', 'max:255'],
        ]);

        $settings = WebsiteSetting::allAsKeyValue();
        $smtpPassword = (string) ($data['smtp_password'] ?? '');
        if ($smtpPassword === '') {
            $smtpPassword = (string) ($settings['smtp.password'] ?? '');
        }

        $map = [
            'name' => $data['name'],
            'email.primary' => $data['email_primary'],
            'email.support' => $data['email_support'] ?? '',
            'phone.raw' => $data['phone_raw'],
            'phone.display' => $data['phone_display'],
            'hours' => $data['hours'],
            'social.facebook' => $data['social_facebook'] ?? '#',
            'social.x_twitter' => $data['social_x_twitter'] ?? '#',
            'social.linkedin' => $data['social_linkedin'] ?? '#',
            'social.pinterest' => $data['social_pinterest'] ?? '#',
            'social.instagram' => $data['social_instagram'] ?? '#',
            'social.google_plus' => $data['social_google_plus'] ?? '#',
            'smtp.enabled' => $request->boolean('smtp_enabled') ? '1' : '0',
            'smtp.host' => (string) ($data['smtp_host'] ?? ''),
            'smtp.port' => (string) ($data['smtp_port'] ?? ''),
            'smtp.username' => (string) ($data['smtp_username'] ?? ''),
            'smtp.password' => $smtpPassword,
            'smtp.encryption' => (string) ($data['smtp_encryption'] ?? ''),
            'smtp.from_address' => (string) ($data['smtp_from_address'] ?? ''),
            'smtp.from_name' => (string) ($data['smtp_from_name'] ?? ''),
            'smtp.to_address' => (string) ($data['smtp_to_address'] ?? ''),
        ];

        foreach ($map as $key => $value) {
            WebsiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => (string) $value]
            );
        }

        return back()->with('status', __('admin.settings_updated'));
    }
}
