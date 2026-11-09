<?php

namespace App\Http\Middleware;

use App\Models\WebsiteSetting;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Response;

class LoadWebsiteSettings
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Schema::hasTable('website_settings')) {
            $settings = WebsiteSetting::allAsKeyValue();

            if (!empty($settings)) {
                $business = config('business', []);

                foreach ($settings as $key => $value) {
                    data_set($business, $key, $value);
                }

                config(['business' => $business]);

                $smtpEnabled = filter_var($settings['smtp.enabled'] ?? false, FILTER_VALIDATE_BOOLEAN);
                if ($smtpEnabled) {
                    $smtpHost = (string) ($settings['smtp.host'] ?? '');
                    $smtpPort = (int) ($settings['smtp.port'] ?? 0);
                    $smtpUser = (string) ($settings['smtp.username'] ?? '');
                    $smtpPass = (string) ($settings['smtp.password'] ?? '');

                    if ($smtpHost !== '' && $smtpPort > 0 && $smtpUser !== '' && $smtpPass !== '') {
                        config([
                            'mail.default' => 'smtp',
                            'mail.mailers.smtp.host' => $smtpHost,
                            'mail.mailers.smtp.port' => $smtpPort,
                            'mail.mailers.smtp.username' => $smtpUser,
                            'mail.mailers.smtp.password' => $smtpPass,
                            'mail.mailers.smtp.scheme' => (string) ($settings['smtp.encryption'] ?? ''),
                            'mail.from.address' => (string) ($settings['smtp.from_address'] ?? config('mail.from.address')),
                            'mail.from.name' => (string) ($settings['smtp.from_name'] ?? config('mail.from.name')),
                            'mail.contact_to_address' => (string) ($settings['smtp.to_address'] ?? config('business.email.primary')),
                        ]);
                    }
                }
            }
        }

        return $next($request);
    }
}
