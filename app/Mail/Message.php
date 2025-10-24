<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Message extends Mailable
{
    use Queueable, SerializesModels;

    public string $body;
    public string $fromAddress;
    public string $subjectLine;

    /**
     * Create a new message instance.
     */
    public function __construct($from, $subject, $body)
    {
        $this->fromAddress = $from;
        $this->subjectLine = $subject;
        $this->body = $body;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this
            ->from($this->fromAddress)
            ->subject($this->subjectLine)
            ->view('emails.message')
            ->with([
                'body' => $this->body,
            ]);
    }
}
