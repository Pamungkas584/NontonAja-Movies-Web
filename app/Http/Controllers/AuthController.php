<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // Fungsi menampilkan halaman login (sudah ada sebelumnya)
    public function login()
    {
        $backgroundMovies = Movie::whereNotNull('thumbnail_url')->inRandomOrder()->take(6)->get();
        return view('auth.login', compact('backgroundMovies'));
    }

    // 1. Mengarahkan user ke halaman login Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // 2. Menangkap data balikan dari Google setelah user memilih akun
    public function handleGoogleCallback()
    {
        try {
            // Ambil data user dari Google
            $googleUser = Socialite::driver('google')->stateless()->user();
            // Membuat username otomatis dari nama yang ada di gogle
            // Jika akun Google kebetulan punya nickname, pakai itu. Jika tidak, ambil dari nama asli.
            $generatedUsername = $googleUser->getNickname() ?? Str::slug($googleUser->getName(), '');

            // Cek apakah user sudah ada di database berdasarkan google_id atau email
            $user = User::updateOrCreate(
                ['google_id' => $googleUser->getId()], // Syarat pencarian
                [
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'username' => $generatedUsername, // Username sementara yang diminta
                    'avatar_url' => $googleUser->getAvatar(),
                    'password' => null, // Tidak butuh password
                    // 'vip_until' dibiarkan null secara default untuk user baru
                ]
            );

            // Paksa user login ke dalam sistem (parameter 'true' berfungsi sebagai remember_token/cookie)
            Auth::login($user, true);

            // Arahkan kembali ke halaman Home
            return redirect('/');

        } catch (\Exception $e) {
            // tampilkan eror
            dd($e);
            // return redirect('/login')->with('error', 'Gagal login menggunakan Google. Silakan coba lagi.');
        }
    }

    // Menghapus sesi dan mengeluarkan user
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}