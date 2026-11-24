<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserLoginNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public User $user
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'user_id' => $this->user->id,
            'email' => $this->user->email,
            'message' => 'Pengguna berhasil login.',
            'login_at' => now()->toDateTimeString(),
        ];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Pemberitahuan Login Pengguna - Hoshizora Gakuin')
            ->greeting('Halo, Admin!')
            ->line('Terdapat pengguna yang berhasil login ke website Hoshizora Gakuin.')
            ->line('Email pengguna: ' . $this->user->email)
            ->line('Waktu login: ' . now()->format('d-m-Y H:i:s'))
            ->action('Buka Website', url('/home'))
            ->line('Ini merupakan pemberitahuan aktivitas login pengguna.');
    }
}