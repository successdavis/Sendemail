<?php

namespace App\Http\Controllers;

use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MailgunController extends Controller
{
    public function handleIncoming(Request $request)
    {
        // Optional: Verify Mailgun signature for security
        if (!$this->verifyMailgunSignature($request)) {
            return response('Invalid signature', 403);
        }

        // Extract email data
        $sender = $request->input('sender');
        $recipient = $request->input('recipient');
        $subject = $request->input('subject');
        $body = $request->input('body-plain');

        // Example: Log or store in database
        Log::info('📩 New incoming email', compact('sender', 'recipient', 'subject', 'body'));

        $email = Email::create([
            'to' => 'info@vacationapplications.com',
            'from' => $sender,
            'subject' => $subject,
            'body' => $body,
            'type' => 'incoming'
        ]);

        return response('Email received', 200);
    }

    private function verifyMailgunSignature(Request $request): bool
    {
        $token = $request->input('token');
        $timestamp = $request->input('timestamp');
        $signature = $request->input('signature');

        $apiKey = env('MAILGUN_WEBHOOK_SIGNING_KEY', env('MAILGUN_SECRET'));

        $expectedSignature = hash_hmac('sha256', $timestamp . $token, $apiKey);

        return hash_equals($expectedSignature, $signature);
    }
}
