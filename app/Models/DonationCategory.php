<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonationCategory extends Model
{
    use HasFactory;

    protected $fillable = ['title','description','image','status'];

    public function donation(){
        return $this->hasMany(Donation::class,'categories_id','id');
    }
}
