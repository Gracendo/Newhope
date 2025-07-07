<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
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
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function isSuperAdmin()
    {
        return $this->hasRole('Super Admin');
    }
}
