<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Models\Stream;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // Menghitung Total Semua Film
        $totalMovies = Movie::count();

        // Menghitung Film Aktif
        $activeMovies = Movie::whereHas('stream', function ($query) {
            $query->whereNotNull('stream_url')->where('stream_url', '!=', '');
        })->count();

        // Siapkan kerangka pencarian
        $query = Movie::with('stream')->orderBy('created_at', 'desc');

        // Jika ada input dari kotak pencarian AJAX
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('year', 'like', '%' . $request->search . '%')
                ->orWhere('category', 'like', '%' . $request->search . '%'); 
        }

        // Ambil data (10 per halaman) dan sertakan parameter pencarian agar paginasi tidak rusak
        $movies = $query->paginate(10)->appends(['search' => $request->search]);

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

        $streamUrl = $validated['stream_url'] ?? null;
        unset($validated['stream_url']); 

        $validated['rating'] = 0; 
        $validated['banner_url'] = $validated['thumbnail_url'];

        // tabel movies tidak akan kemasukan kolom stream_url
        $movie = Movie::create($validated);

        // Jika ada link pemutaran, simpan ke tabel streams yang terpisah
        if (!empty($streamUrl)) {
            Stream::create([
                'movie_id' => $movie->id,
                'stream_url' => $streamUrl
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

    // Menghapus data film
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        
        // Menghapus film 
        $movie->delete();

        return redirect()->route('admin.movies.index')->with('success', 'Film berhasil dihapus dari database!');
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

        // Ambil nilai stream_url lalu hapus dari array $validated
        $streamUrl = $validated['stream_url'] ?? null;
        unset($validated['stream_url']); 

        // Update tabel movies (hanya memperbarui kolom bawaan film saja)
        $movie->update($validated);

        // Update atau Create data ke tabel streams yang terpisah
        if (!empty($streamUrl)) {
            Stream::updateOrCreate(
                ['movie_id' => $movie->id],
                ['stream_url' => $streamUrl]
            );
        } else {
            // Jika kolom di-kosongkan saat edit, hapus data stream lamanya
            if ($movie->stream) {
                $movie->stream->delete();
            }
        }

        return redirect()->route('admin.movies.index')->with('success', 'Data film berhasil diperbarui!');
    }
}