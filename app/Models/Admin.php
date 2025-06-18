<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'admin_id',
        'firt_name',
        'last_name',
        'username',
        'email',
        'phone',
        'address',
        'state',
        'city',
        'code_zip',
        'country_id',
        'status',
        'email_verified_at',
        'image',
        'password',
        'status',
        'timestamp',
    ];
}
