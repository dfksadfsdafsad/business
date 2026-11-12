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
        $isJapanese = $locale === 'jp';
        $receiverNotConfiguredMessage = $isJapanese
            ? 'お問い合わせ受信用のメールアドレスが設定されていません。'
            : 'Contact receiver email is not configured.';
        $sendFailedMessage = $isJapanese
            ? '現在メッセージを送信できません。SMTP設定をご確認のうえ、もう一度お試しください。'
            : 'Unable to send message right now. Please check SMTP settings and try again.';
        $successMessage = $isJapanese
            ? 'メッセージを送信しました。ありがとうございます。'
            : 'Your message has been sent successfully.';

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
                    'message' => $receiverNotConfiguredMessage,
                ], 422);
            }

            return back()->withErrors(['contact' => $receiverNotConfiguredMessage])->withInput();
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
                    'message' => $sendFailedMessage,
                ], 500);
            }

            return back()->withErrors([
                'contact' => $sendFailedMessage,
            ])->withInput();
        }

        if ($request->expectsJson()) {
            return response()->json([
                'message' => $successMessage,
            ]);
        }

        return back()->with('contact_status', $successMessage);
    }
}
