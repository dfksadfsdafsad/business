<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Throwable;

class ContactMessageController extends Controller
{
    public function send(Request $request, string $locale): RedirectResponse|JsonResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:60'],
            'service' => ['nullable', 'string', 'max:120'],
            'msg' => ['required', 'string', 'max:3000'],
            'terms' => ['accepted'],
        ]);

        $toAddress = (string) config('mail.contact_to_address', config('business.email.primary'));
        if ($toAddress === '') {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Contact receiver email is not configured.',
                ], 422);
            }

            return back()->withErrors(['contact' => 'Contact receiver email is not configured.'])->withInput();
        }

        try {
            Mail::send('emails.contact-message', [
                'locale' => $locale,
                'data' => $data,
            ], function ($message) use ($data, $toAddress): void {
                $message
                    ->to($toAddress)
                    ->replyTo($data['email'], $data['name'])
                    ->subject('Website Contact Message: '.($data['service'] ?: 'General Inquiry'));
            });
        } catch (Throwable $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Unable to send message right now. Please check SMTP settings and try again.',
                ], 500);
            }

            return back()->withErrors([
                'contact' => 'Unable to send message right now. Please check SMTP settings and try again.',
            ])->withInput();
        }

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Your message has been sent successfully.',
            ]);
        }

        return back()->with('contact_status', 'Your message has been sent successfully.');
    }
}
