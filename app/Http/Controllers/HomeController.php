<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class HomeController extends Controller
{
    public function index()
    {
        // 1. LOGIKA HERO BANNER DINAMIS
        // Mengambil 3 film dengan rating tertinggi yang WAJIB memiliki gambar banner
        $heroMovies = Movie::whereNotNull('banner_url')
                           ->orderBy('rating', 'desc') // Urutkan rating dari yang tertinggi
                           ->take(3) // Ambil 3 teratas
                            ->get();
        
        // 2. MENGAMBIL DAFTAR FILM BERDASARKAN GENRE
        // Kita tambahkan juga orderBy agar film yang tampil diurutkan dari yang paling bagus/populer
        $dramaMovies = Movie::where('category', 'Drama')
                            ->orderBy('rating', 'desc')
                            ->get();
                            
        $actionMovies = Movie::where('category', 'Action')
                            ->orderBy('rating', 'desc')
                            ->get();

        return view('home', compact('heroMovies', 'dramaMovies', 'actionMovies'));
    }
}