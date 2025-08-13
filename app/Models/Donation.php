<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'currency',
        'payment_method',
        'phone_number',
        'reference',
        'status',
        'anonymous',
        'donor_name',
        'donor_email',
        'message',
        'user_id',
        'external_reference',
        'campay_response',
        'network_transaction_id',
        'orphanage_id',
        'campaign_id'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'anonymous' => 'boolean',
        'completed_at' => 'datetime',
    ];

    // Status constants
    const STATUS_PENDING = 'pending';
    const STATUS_SUCCESSFUL = 'successful';
    const STATUS_FAILED = 'failed';

    // Payment method constants
    const METHOD_MTN = 'MTN';
    const METHOD_ORANGE = 'ORANGE';

    /**
     * Get the user who made the donation
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if donation is successful
     */
    public function isSuccessful()
    {
        return $this->status === self::STATUS_SUCCESSFUL;
    }

    /**
     * Scope for successful donations
     */
    public function scopeSuccessful($query)
    {
        return $query->where('status', self::STATUS_SUCCESSFUL);
    }

    /**
     * Scope for pending donations
     */
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    /**
     * Get the donor name (returns "Anonymous" if donation is anonymous)
     */
    public function getDonorDisplayNameAttribute()
    {
        return $this->anonymous ? 'Anonymous' : $this->donor_name;
    }
    // app/Models/Donation.php

public function orphanage()
{
    return $this->belongsTo(Orphanage::class);
}

public function campaign()
{
    return $this->belongsTo(Campaign::class);
}
}