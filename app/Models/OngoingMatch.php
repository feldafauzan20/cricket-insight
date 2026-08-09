<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OngoingMatch extends Model
{
    protected $table = 'ongoing_matches';

    protected $guarded = ['id'];

    protected $casts = [
        'time_date' => 'datetime',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];
}
