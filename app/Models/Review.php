<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['user_id', 'movie_id', 'comment', 'rating'];

    // Satu ulasan dimiliki oleh satu User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Satu ulasan dimiliki oleh satu Movie
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
