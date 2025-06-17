<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;
    protected $fillable = [
        'Orphanage_id',
        'id',
        'name',
        'image',
        'gallery',
        'description',
        'start_date',
        'end_date',
        'created_at',
        'project_duration',
        'objectif',
        'status',
        'business_plan',
        'goal_amount',
        'prefered_amounts',
        'raised_amount',
        'phone',
       
    ];
}
