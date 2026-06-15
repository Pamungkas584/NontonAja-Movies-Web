<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Review;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Kolom yang diizinkan untuk diisi secara massal
    protected $fillable = [
        'name',
        'email',
        'username',
        'google_id',
        'avatar_url',
        'password',
        'vip_until',
    ];

    // Menyembunyikan data rahasia saat diubah menjadi JSON
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Memberitahu Laravel bahwa vip_until adalah data Tanggal/Waktu
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'vip_until' => 'datetime', // Akan otomatis diubah jadi format Carbon
    ];

    // Fungsi tambahan untuk mengecek apakah user masih VIP
    public function isVip()
    {
        return $this->vip_until && $this->vip_until->isFuture();
    }

    //relasi user ke review
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}