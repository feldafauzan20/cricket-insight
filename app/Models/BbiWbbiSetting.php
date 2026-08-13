<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BbiWbbiSetting extends Model
{
    protected $table = 'bbi_wbbi_settings';

    protected $guarded = ['id'];

    protected $casts = [
        'latest_bbi_date' => 'date',
        'highlights' => 'array',
    ];

    public function article1(): BelongsTo
    {
        return $this->belongsTo(Article::class, 'article_1_id');
    }

    public function article2(): BelongsTo
    {
        return $this->belongsTo(Article::class, 'article_2_id');
    }

    public function article3(): BelongsTo
    {
        return $this->belongsTo(Article::class, 'article_3_id');
    }

    public function brandStory1(): BelongsTo
    {
        return $this->belongsTo(Article::class, 'brand_story_1_id');
    }

    public function brandStory2(): BelongsTo
    {
        return $this->belongsTo(Article::class, 'brand_story_2_id');
    }

    public function brandStory3(): BelongsTo
    {
        return $this->belongsTo(Article::class, 'brand_story_3_id');
    }

    public function getFormattedLatestBbiDateAttribute(): ?string
    {
        return $this->latest_bbi_date?->format('M, d Y');
    }
}
