<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orphanage extends Model
{
    use HasFactory;
    protected $fillable = [
        'Orphanage_id',
        'user_id',
        'name',
        'longitude',
        'latitude',
        'country',
        'city',
        'logo',
        'num_enregistrement',
        'description',
        'address',
        'region',
        'email',
        'phone',
       
    ];
}
