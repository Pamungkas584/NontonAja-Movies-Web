<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $movieId)
    {
        // Validasi komentar agar tidak kosong dan tidak terlalu panjang
        $request->validate([
            'comment' => 'required|string|max:500',
        ]);

        // Simpan ke database
        Review::create([
            'user_id' => Auth::id(),
            'movie_id' => $movieId,
            'comment' => $request->comment,
            // Rating tidak dimasukkan sesuai desain yang diminta
        ]);

        // Kembalikan pengguna ke halaman film yang sama dengan pesan sukses
        return back()->with('success', 'Ulasan Anda berhasil ditambahkan!');
    }
}