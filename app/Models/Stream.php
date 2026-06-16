<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stream extends Model
{
    protected $fillable = ['movie_id', 'stream_url'];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}