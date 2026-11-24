<?php

namespace App\Listeners;

use App\Mail\LoginBerhasil;
use App\Models\User;
use App\Notifications\UserLoginNotification;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Throwable;

class SendLoginNotification
{
    public function handle(Login $event): void
    {
        $user = $event->user;
        try {
            Mail::to($user->email)->send(
                new LoginBerhasil($user)
            );
        } catch (Throwable $e) {
            Log::error('Gagal mengirim email notifikasi login', [
                'user_id' => $user->id,
                'email' => $user->email,
                'error' => $e->getMessage(),
            ]);
        }

        if ($user->level === 'user') {
            $admins = User::where('level', 'admin')->get();
            foreach ($admins as $admin) {
                try {
                    $admin->notify(
                        new UserLoginNotification($user)
                    );
                } catch (Throwable $e) {
                    Log::error('Gagal memasukkan notification Admin ke Queue', [
                        'admin_id' => $admin->id,
                        'error' => $e->getMessage(),
                    ]);
                }
            }
        }
    }
}
