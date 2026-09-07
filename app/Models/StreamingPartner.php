<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class StreamingPartner extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'image_dark',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Accessor for full image URL.
     */
    public function getImageUrlAttribute(): string
    {
        if (empty($this->image)) {
            return '';
        }

        if (Str::startsWith($this->image, ['images/', 'http://', 'https://'])) {
            return asset($this->image);
        }

        return asset('storage/' . $this->image);
    }

    /**
     * Accessor for full dark-mode image URL. Empty string if not set.
     */
    public function getImageDarkUrlAttribute(): string
    {
        if (empty($this->image_dark)) {
            return '';
        }

        if (Str::startsWith($this->image_dark, ['images/', 'http://', 'https://'])) {
            return asset($this->image_dark);
        }

        return asset('storage/' . $this->image_dark);
    }
}
