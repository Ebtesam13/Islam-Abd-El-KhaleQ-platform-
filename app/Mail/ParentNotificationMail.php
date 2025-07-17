<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ParentNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct($url,$score,$quizName,$parentName,$fullMark,$studentName)
    {
        $this->url = $url;
        $this->score = $score;
        $this->quizName = $quizName;
        $this->parentName = $parentName;
        $this->fullMark = $fullMark;
        $this->studentName = $studentName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Child’s Achievement Update – See Their Quiz Results!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.parent_notification',
        with: [
        'url' => $this->url,
        'score' => $this->score,
        'quizName' => $this->quizName,
        'parentName' => $this->parentName,
        'fullMark' => $this->fullMark,
        'studentName' => $this->studentName,
    ],
    );
}

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
