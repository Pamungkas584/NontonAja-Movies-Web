<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller
{
    public function show($id)
    {
        // Mencari film berdasarkan ID di database
        $movie = Movie::findOrFail($id);

        // Mengambil film "Lainnya Seperti Ini" (Genre sama, kecuali film ini sendiri)
        $relatedMovies = Movie::where('category', $movie->category)
                            ->where('id', '!=', $movie->id)
                            ->orderBy('rating', 'desc')
                            ->take(6)
                            ->get();

        return view('movies.show', compact('movie', 'relatedMovies'));
    }

    // Menampilkan halaman daftar semua film
    public function index(Request $request)
    {
        // Mengambil kategori dari URL (jika ada), default 'Semua'
        $activeCategory = $request->query('category', 'Semua');

        // Film Populer (Diurutkan dari rating tertinggi)
        $popularMovies = Movie::orderBy('rating', 'desc')->take(10)->get();

        // Film Terbaru (Diurutkan dari tahun rilis paling baru)
        $latestMovies = Movie::orderBy('year', 'desc')->take(10)->get();

        // Semua Film (Menggunakan pagination agar rapi)
        // Jika ada filter kategori selain 'Semua', 'Populer', 'Terbaru', maka saring datanya
        $query = Movie::query();
        if (!in_array($activeCategory, ['Semua', 'Populer', 'Terbaru'])) {
            $query->where('category', 'like', "%{$activeCategory}%");
        }
        
        // Membagi data (paginate) sebanyak 18 film per halaman
        $allMovies = $query->orderBy('title', 'asc')->paginate(18);

        // Kategori statis untuk menu navigasi di atas
        $categories = ['Semua', 'Populer', 'Terbaru', 'Drama', 'Action', 'Comedy', 'Romance', 'Horror', 'Thriller', 'Lainnya'];

        return view('movies.index', compact('popularMovies', 'latestMovies', 'allMovies', 'activeCategory', 'categories'));
    }
    
}