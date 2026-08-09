<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes;

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
}