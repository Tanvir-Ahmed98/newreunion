<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Registration extends Model
{
    protected $fillable = [
        'name', 'email', 'phone',
        'ssc_batch', 'hsc_batch', 'guest_above_12',

        // new
        'batch', 'location', 'profession',
        'guests_total', 'tshirt_size', 'donation_bdt', 'photo_path',
    ];

    protected $casts = [
        'guest_above_12' => 'integer',
        'donation_bdt'   => 'integer',
        'guests_total'   => 'integer', // 0..5 (5 means 5+)
    ];

    protected $appends = ['photo_url'];

    public function getPhotoUrlAttribute(): ?string
    {
        if (!$this->photo_path) return null;
        return Storage::disk('public')->url($this->photo_path);
    }
}
