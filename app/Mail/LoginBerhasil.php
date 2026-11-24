<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class LoginBerhasil extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public User $user
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Login Berhasil - Hoshizora Gakuin',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.login-berhasil',
            with: ['user' => $this->user,],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
