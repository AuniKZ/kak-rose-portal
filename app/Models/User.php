<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get all appointments for the user.
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Get all intake forms for the user.
     */
    public function intakeForms()
    {
        return $this->hasMany(IntakeForm::class);
    }

    /**
     * Send a customized password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPasswordNotification($token));
    }
}

/**
 * Custom Reset Password Notification Class
 */
class CustomResetPasswordNotification extends ResetPassword
{
    public function toMail($notifiable)
    {
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        // Path to your logo or banner image inside public/images/logo.png
        $imagePath = public_path('images/image.png');

        $mail = (new MailMessage)
            ->subject('Reset Your Password - Kak Rose Urutan Melayu')
            ->greeting('Hello ' . ($notifiable->name ?? 'Valued Client') . ',')
            ->line('We received a request to reset your password for your Kak Rose Urutan Melayu member account.')
            ->action('Reset Password', $url)
            ->line('This password reset link will expire in 60 minutes.')
            ->line('If you did not request a password reset, no further action is required.')
            ->salutation("Warm regards,\nKak Rose Urutan Melayu");

        return $mail;
    }
}