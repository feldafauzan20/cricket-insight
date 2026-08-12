<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'is_active' => 'boolean',
        'is_adsense_active' => 'boolean',
        'hide_placeholder' => 'boolean',
    ];
}