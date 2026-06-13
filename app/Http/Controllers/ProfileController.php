<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Movie;

class ProfileController extends Controller
{
    // Menampilkan halaman profil
    public function index()
    {
        // Mengambil 1 gambar backdrop acak dari database untuk latar belakang banner profil
        $bannerMovie = Movie::whereNotNull('banner_url')->inRandomOrder()->first();
        
        return view('profile.index', compact('bannerMovie'));
    }

    // Memperbarui nama pengguna
    public function updateName(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->save();

        return redirect()->back()->with('success', 'Nama berhasil diperbarui!');
    }

    // VIP Buy option
    public function vip()
    {
        return view('profile.vip');
    }
}