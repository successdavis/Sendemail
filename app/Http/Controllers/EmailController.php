<?php

namespace App\Http\Controllers;

use App\Mail\Message;
use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class EmailController extends Controller
{
    public function inbox()
    {
        return Inertia::render('Index');
    }
    public function composeNewMessage()
    {
        return Inertia::render('Create');
    }

    public function sendEmail(Request $request)
    {
        // Step 1: Validate request
        $validated = $request->validate([
            'to' => 'required|email',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $email = Email::create([
            'to' => $validated['to'],
            'from' => 'info@vacationapplications.com',
            'subject' => $validated['subject'],
            'body' => $validated['body'],
        ]);

        try {
            Mail::to($email->to)->send(
                new Message(
                    $email->to,
                    'info@vacationapplications.com',
                    $validated['subject'],
                    $validated['body']
                )
            );

            Log::info('Email sent successfully', ['to' => $validated['to']]);

            return response()->json([
                'status' => 'success',
                'message' => 'Email sent successfully.',
            ], 200);

        } catch (\Exception $e) {
            Log::error('Email sending failed', [
                'error' => $e->getMessage(),
                'to' => $validated['to']
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to send email.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
