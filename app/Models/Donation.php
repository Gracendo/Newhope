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
        'campaign_id',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'anonymous' => 'boolean',
        'completed_at' => 'datetime',
    ];

    // Status constants
    public const STATUS_PENDING = 'pending';
    public const STATUS_SUCCESSFUL = 'successful';
    public const STATUS_FAILED = 'failed';

    // Payment method constants
    public const METHOD_MTN = 'MTN';
    public const METHOD_ORANGE = 'ORANGE';

    /**
     * Get the user who made the donation.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if donation is successful.
     */
    public function isSuccessful()
    {
        return $this->status === self::STATUS_SUCCESSFUL;
    }

    /**
     * Scope for successful donations.
     */
    public function scopeSuccessful($query)
    {
        return $query->where('status', self::STATUS_SUCCESSFUL);
    }

    /**
     * Scope for pending donations.
     */
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    /**
     * Get the donor name (returns "Anonymous" if donation is anonymous).
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
    // relations to handle donation on the side of the admin
    // In app/Models/Donation.php

    // Add this method to display the correct amount based on role
    public function getDisplayAmountAttribute()
    {
        if (auth('admin')->check() && auth('admin')->user()->role === 'orphanagemanager') {
            return $this->amount * 0.9;
        }

        return $this->amount;
    }

    public function getDisplayRaisedAttribute()
    {
        if (auth('admin')->check() && auth('admin')->user()->role === 'orphanagemanager') {
            return $this->raised * 0.9;
        }

        return $this->raised;
    }

    public function scopeFailed($query)
    {
        return $query->where('status', self::STATUS_FAILED);
    }
}
