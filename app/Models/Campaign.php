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
   
    protected $casts = [
        'gallery' => 'array',
        ];


    public function isApproved()
    {
        return $this->status === 'approved';
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isRejected()
    {
        return $this->status === 'rejected';
    }
    public function volunteers()
{
    return $this->hasMany(Volunteer::class);
}
    

}
