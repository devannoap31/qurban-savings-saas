<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class CustomVerifyEmail extends BaseVerifyEmail
{
    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);
        
        $roleName = $notifiable->role === 'admin' ? 'Pengurus Masjid (Mitra)' : 'Jemaah';

        return (new MailMessage)
            ->subject('Verifikasi Alamat Email Anda - Sylvan Kurban')
            ->greeting('Halo ' . $notifiable->name . '!')
            ->line('Terima kasih telah mendaftar sebagai ' . $roleName . ' di Sylvan Kurban.')
            ->line('Silakan klik tombol di bawah ini untuk memverifikasi alamat email Anda.')
            ->action('Verifikasi Email Saya', $verificationUrl)
            ->line('Jika Anda tidak merasa mendaftar di Sylvan Kurban, Anda dapat mengabaikan email ini.');
    }
}
