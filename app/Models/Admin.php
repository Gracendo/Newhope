<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Notifications\VerifyEmailNotification;

class Admin extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasRoles;

    protected $fillable = [
        'last_name',
        'first_name',
        'email',
        'image',
        'role',
        'status',
        'password',
        'username',
        'email_verified',
        'status',
        'activation_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function isSuperAdmin()
    {
        return $this->hasRole('Super Admin');
    }
    // In your Admin model

public function sendEmailVerificationNotification()
    {
        try {
            $this->notify(new VerifyEmailNotification());
            Log::info('Verification email dispatched', [
                'user_id' => $this->id,
                'email' => $this->email
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send verification email', [
                'error' => $e->getMessage(),
                'user_id' => $this->id,
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }
    /**
     * Check if email is verified
     */
    public function hasVerifiedEmail()
    {
        return $this->email_verified === 1;
    }

    /**
     * Mark email as verified
     */
    public function markEmailAsVerified()
    {
        return $this->forceFill([
            'email_verified' => 1
        ])->save();
    }

}
