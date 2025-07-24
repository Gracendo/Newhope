<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orphanage extends Model
{
    use HasFactory;

    protected $fillable = [
        'orphanage_id',
        'admin_id',  // This links to the Admin who manages this orphanage
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

    /**
     * Get the admin (orphanage manager) who manages this orphanage
     */
    public function manager()  // Renamed from admin() for clarity
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    /**
     * Get all campaigns for this orphanage
     */
    public function campaigns()
    {
        return $this->hasMany(Campaign::class, 'orphanage_id');
    }

    /**
     * Get the logo URL (accessor)
     */
    public function getLogoUrlAttribute()
    {
        if ($this->logo) {
            return Storage::url($this->logo);
        }
        return null;
    }
}