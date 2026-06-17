<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Watchlist extends Model
{
    use HasFactory;

    // Mengizinkan pengisian kolom (Mass Assignment)
    protected $fillable = [
        'user_id',
        'movie_id',
    ];


    // (Satu baris watchlist ini milik siapa?)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // (Satu baris watchlist ini merekam film apa?)
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}