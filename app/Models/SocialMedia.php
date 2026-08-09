<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    protected $table = 'social_medias';
    protected $guarded = ['id'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}