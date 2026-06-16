<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Review;


class Movie extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Satu film punya satu link streaming
    public function stream()
    {
        return $this->hasOne(Stream::class);
    }
}