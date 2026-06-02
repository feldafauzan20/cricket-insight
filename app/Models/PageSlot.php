<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageSlot extends Model
{
    protected $guarded = ['id'];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function video()
    {
        return $this->belongsTo(Video::class);
    }
}