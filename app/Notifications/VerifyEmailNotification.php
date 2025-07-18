<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;

class VerifyEmailNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Build the verification URL
     */
    protected function verificationUrl($notifiable)
    {
        try {
            return URL::temporarySignedRoute(
                'verification.verify',
                now()->addMinutes(config('auth.verification.expire', 60)),
                [
                    'id' => $notifiable->getKey(),
                    'hash' => sha1($notifiable->getEmailForVerification()),
                ]
            );
        } catch (\Exception $e) {
            Log::error('Failed to generate verification URL', [
                'error' => $e->getMessage(),
                'user_id' => $notifiable->id ?? 'unknown'
            ]);
            throw $e;
        }
    }

    /**
     * Build the mail message
     */
    public function toMail($notifiable)
    {
        try {
            $verificationUrl = $this->verificationUrl($notifiable);

            Log::info('Sending verification email', [
                'user_id' => $notifiable->id,
                'email' => $notifiable->email,
                'url' => $verificationUrl
            ]);

            $mail = (new MailMessage())
                ->subject('Verify Your Email Address')
                ->line('Please click below to verify your email address.')
                ->action('Verify Email', $verificationUrl);

            if ($notifiable instanceof \App\Models\Admin) {
                $mail->line('After verification, you can login to the admin panel.');
            }

            return $mail;
        } catch (\Exception $e) {
            Log::error('Failed to build verification email', [
                'error' => $e->getMessage(),
                'user_id' => $notifiable->id ?? 'unknown'
            ]);
            throw $e;
        }
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            // Additional data if needed
        ];
    }
}