<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Watchlist extends Model
{
    use HasFactory;

    // 1. Mengizinkan pengisian kolom (Mass Assignment)
    protected $fillable = [
        'user_id',
        'movie_id',
    ];

    // 2. Relasi Balik ke tabel User
    // (Satu baris watchlist ini milik siapa?)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 3. Relasi Balik ke tabel Movie
    // (Satu baris watchlist ini merekam film apa?)
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}