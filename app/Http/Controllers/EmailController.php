<?php

namespace App\Http\Controllers;

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

        try {
            // Step 2: Send email
            Mail::html($validated['body'], function ($message) use ($validated) {
                $message->to($validated['to'])
                    ->subject($validated['subject']);
            });

            // Step 3: Log and return success
            Log::info('Email sent successfully', ['to' => $validated['to']]);

            return response()->json([
                'status' => 'success',
                'message' => 'Email sent successfully.',
            ], 200);

        } catch (\Exception $e) {
            // Step 4: Log and return error
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
