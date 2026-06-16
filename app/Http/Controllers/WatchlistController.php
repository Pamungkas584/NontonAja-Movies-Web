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
}