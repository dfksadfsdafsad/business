<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminLocaleController extends Controller
{
    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'locale' => ['required', 'in:en,jp'],
        ]);

        $request->session()->put('admin_locale', $data['locale']);

        return back()->with('status', __('admin.language_updated'));
    }
}
