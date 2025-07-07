<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orphanage extends Model
{
    use HasFactory;
    protected $fillable = [
        'Orphanage_id',
        'admin_id',
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

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
