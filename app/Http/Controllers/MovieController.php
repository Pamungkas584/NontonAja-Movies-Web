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
}