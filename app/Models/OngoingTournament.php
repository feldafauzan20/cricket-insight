<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OngoingTournament extends Model
{
    protected $table = 'ongoing_tournaments';

    protected $guarded = ['id'];

    protected $casts = [
        'time_date' => 'datetime',
    ];
}
