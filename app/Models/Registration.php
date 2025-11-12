<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes; // 🧩 Soft Delete support
class Registration extends Model
{
     use SoftDeletes;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'location',
        'profession',
        'blood_group',
        'batch',
         'live_abroad',
        'guests_total',
        'guest_above_12',
        'tshirt_size',
        'client_reg_id',
        'payable_amount',
        'eusCAA_contribution',
        'photo_path',

        // 💰 Payment-related fields
        'payment_status',
        'transaction_id',
        'payment_token',
        'payment_expires_at',
    ];

    protected $casts = [
        'guest_above_12'     => 'integer',
        'guests_total'       => 'integer',
        'payable_amount'     => 'decimal:2',
        'payment_expires_at' => 'datetime',
    ];

    protected $appends = ['photo_url'];

    /**
     * ✅ Automatically provide public URL for stored photo
     */
    public function getPhotoUrlAttribute(): ?string
    {
        return $this->photo_path
            ? Storage::disk('public')->url($this->photo_path)
            : null;
    }

    /**
     * ✅ Determine if payment link is still active
     */
    public function getIsPaymentLinkActiveAttribute(): bool
    {
        return $this->payment_status === 'unpaid'
            && $this->payment_expires_at
            && now()->lessThan($this->payment_expires_at);
    }

    /**
     * ✅ Check if payment already completed
     */
    public function getIsPaidAttribute(): bool
    {
        return $this->payment_status === 'paid';
    }
}
