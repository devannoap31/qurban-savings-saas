<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class CustomResetPassword extends Notification
{
    use Queueable;

    public $token;

    /**
     * Create a notification instance.
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('Pemberitahuan Reset Kata Sandi - Sylvan Kurban')
            ->greeting('Halo ' . $notifiable->name . '!')
            ->line('Anda menerima email ini karena kami menerima permintaan untuk mereset kata sandi akun Anda di sistem Sylvan Kurban.')
            ->action('Reset Kata Sandi', $url)
            ->line('Link reset kata sandi ini akan kedaluwarsa dalam ' . config('auth.passwords.'.config('auth.defaults.passwords').'.expire') . ' menit.')
            ->line('Jika Anda tidak merasa meminta reset kata sandi, abaikan email ini dan akun Anda akan tetap aman.')
            ->salutation('Salam hormat, Tim Sylvan Kurban');
    }
}
