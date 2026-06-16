<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Models\Stream;

class AdminController extends Controller
{
    public function index()
    {
        // Menghitung Total Semua Film
        $totalMovies = Movie::count();

        // Menghitung Film Aktif (Hanya film yang memiliki relasi stream dan URL-nya tidak kosong)
        $activeMovies = Movie::whereHas('stream', function ($query) {
            $query->whereNotNull('stream_url')->where('stream_url', '!=', '');
        })->count();

        // Mengambil data film untuk tabel, diurutkan dari yang terbaru (pagination 10 per halaman)
        $movies = Movie::with('stream')->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.movies.index', compact('totalMovies', 'activeMovies', 'movies'));
    }

    // Menampilkan form tambah
    public function create()
    {
        return view('admin.movies.form');
    }

    // Menyimpan data film baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'year' => 'required|string|max:4',
            'thumbnail_url' => 'required|url',
            'category' => 'required|string',
            'age_rating' => 'required|string',
            'description' => 'required|string',
            'stream_url' => 'nullable|url',
        ]);

        // Beri nilai default untuk rating dan banner (bisa dikembangkan nanti)
        $validated['rating'] = 0; 
        $validated['banner_url'] = $validated['thumbnail_url'];

        // Simpan ke tabel movies
        $movie = Movie::create($validated);

        // Jika ada link pemutaran, simpan ke tabel streams
        if ($request->filled('stream_url')) {
            Stream::create([
                'movie_id' => $movie->id,
                'stream_url' => $request->stream_url
            ]);
        }

        return redirect()->route('admin.movies.index')->with('success', 'Film berhasil ditambahkan!');
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $movie = Movie::with('stream')->findOrFail($id);
        return view('admin.movies.form', compact('movie'));
    }

    // Memperbarui data film
    public function update(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'year' => 'required|string|max:4',
            'thumbnail_url' => 'required|url',
            'category' => 'required|string',
            'age_rating' => 'required|string',
            'description' => 'required|string',
            'stream_url' => 'nullable|url',
        ]);

        // Update tabel movies
        $movie->update($validated);

        // Update atau Create tabel streams
        if ($request->filled('stream_url')) {
            Stream::updateOrCreate(
                ['movie_id' => $movie->id],
                ['stream_url' => $request->stream_url]
            );
        } else {
            // Jika dikosongkan, hapus stream yang ada
            if ($movie->stream) {
                $movie->stream->delete();
            }
        }

        return redirect()->route('admin.movies.index')->with('success', 'Data film berhasil diperbarui!');
    }
}