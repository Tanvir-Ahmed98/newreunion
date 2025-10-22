<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Registration extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'location',
        'profession',
        'batch',
        'guests_total',
        'guest_above_12',
        'tshirt_size',
        'client_reg_id',
        'payable_amount', // ✅ correct field name
        'photo_path',
    ];

    protected $casts = [
        'guest_above_12' => 'integer',
        'guests_total'   => 'integer',
        'payable_amount' => 'decimal:2',
    ];

    protected $appends = ['photo_url'];

    // ✅ Automatically provide public URL for stored photo
    public function getPhotoUrlAttribute(): ?string
    {
        return $this->photo_path
            ? Storage::disk('public')->url($this->photo_path)
            : null;
    }
}
