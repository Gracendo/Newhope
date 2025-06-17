<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
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
