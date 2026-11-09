<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetAdminLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->is('admin') && !$request->is('admin/*')) {
            return $next($request);
        }

        $allowed = ['en', 'jp'];
        $locale = (string) $request->session()->get('admin_locale', 'en');

        if (!in_array($locale, $allowed, true)) {
            $locale = 'en';
        }

        app()->setLocale($locale);

        return $next($request);
    }
}
