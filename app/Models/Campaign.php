<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function orphanage()
    {
        return $this->belongsTo(Orphanage::class);
    }
}
