<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'Orphanage_id',
        'campaign_id',
        'user',
        'amount',
        'charge',
        'final_amount',
        'currency',
        'convertion_rate',
        'donor_name',
        'donor_email',
        'donation_type',
        'is_anonymous',
        'message',
        'status',
        'transaction_id',
        'payment_details',
        'created_at',
        'updated_at',

       
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
