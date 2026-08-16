<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use RalphJSmit\Laravel\SEO\Support\HasSEO;

class Article extends Model
{
    use HasFactory, SoftDeletes, HasSEO;

    protected $guarded = ['id'];

    protected $casts = [
        'match_date' => 'datetime',
        'published_at' => 'datetime',
        'is_editor_choice' => 'boolean',
        'is_trending_manual' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getPdfBase64Attribute(): ?string
    {
        if (!$this->pdf_file || !\Illuminate\Support\Facades\Storage::disk('public')->exists($this->pdf_file)) {
            return null;
        }

        $content = \Illuminate\Support\Facades\Storage::disk('public')->get($this->pdf_file);
        return 'data:application/pdf;base64,' . base64_encode($content);
    }

    private function hasTranslation(?string $value): bool
    {
        return $value !== null && trim(strip_tags($value)) !== '';
    }

    public function getTitleAttribute($value)
    {
        if (app()->getLocale() === 'en' && $this->hasTranslation($this->attributes['title_en'] ?? null)) {
            return $this->attributes['title_en'];
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

    public function getContentAttribute($value)
    {
        if (app()->getLocale() === 'en' && $this->hasTranslation($this->attributes['content_en'] ?? null)) {
            return $this->attributes['content_en'];
        }
        return $value;
    }

    public function getTitleIdAttribute()
    {
        return $this->attributes['title'] ?? null;
    }

    public function getDescriptionIdAttribute()
    {
        return $this->attributes['description'] ?? null;
    }

    public function getContentIdAttribute()
    {
        return $this->attributes['content'] ?? null;
    }
}
