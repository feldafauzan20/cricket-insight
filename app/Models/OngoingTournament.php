<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OngoingTournament extends Model
{
    protected $table = 'ongoing_tournaments';

    protected $guarded = ['id'];

    protected $casts = [
        'time_date' => 'datetime',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    private function hasTranslation(?string $value): bool
    {
        return $value !== null && trim(strip_tags($value)) !== '';
    }

    public function getTournamentTitleAttribute($value)
    {
        if (app()->getLocale() === 'en' && $this->hasTranslation($this->attributes['tournament_title_en'] ?? null)) {
            return $this->attributes['tournament_title_en'];
        }
        return $value;
    }

    public function getDescriptionAttribute($value)
    {
        if (app()->getLocale() === 'en' && $this->hasTranslation($this->attributes['description_en'] ?? null)) {
            return $this->attributes['description_en'];
        }
        return $value;
    }

    public function getTournamentTitleIdAttribute()
    {
        return $this->attributes['tournament_title'] ?? null;
    }

    public function getDescriptionIdAttribute()
    {
        return $this->attributes['description'] ?? null;
    }
}

