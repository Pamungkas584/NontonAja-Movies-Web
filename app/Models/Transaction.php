<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Kolom yang diizinkan untuk diisi
    protected $fillable = [
        'user_id',
        'order_id',
        'package_name',
        'amount',
        'status',
        'snap_token',
    ];

    // Relasi ke tabel users (Satu transaksi dimiliki oleh satu user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}