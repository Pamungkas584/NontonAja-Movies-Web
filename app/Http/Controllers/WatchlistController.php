<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class WatchlistController extends Controller
{

    public function toggle($movieId)
    {
        $user = Auth::user();

        // Memastikan user sudah login sebelum mengeksekusi relasi
        if (!$user) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu');
        }

        // Jalankan fungsi toggle: otomatis insert jika belum ada, otomatis delete jika sudah ada
        $user->watchlists()->toggle($movieId);

        // Kembalikan user ke halaman sebelumnya dengan pesan sukses yang dinamis
        return redirect()->back()->with('success', 'Daftar tontonan Anda berhasil diperbarui');
    }

    // Menampilkan semua film yang ada di watchlist user
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Mengambil daftar film yang ditambahkan oleh user dengan sistem pagination (misal 18 film per halaman)
        $watchlistMovies = $user->watchlists()->orderBy('watchlists.created_at', 'desc')->paginate(18);

        return view('movies.watchlist', compact('watchlistMovies'));
    }
}