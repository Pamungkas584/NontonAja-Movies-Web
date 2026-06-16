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

    // Menampilkan halaman spesifik berdasarkan Kategori/Genre
    public function category($categoryName)
    {
        // Query dasar pencarian film
        $query = Movie::query();

        // Siapkan deskripsi dinamis agar tampilan lebih hidup
        $descriptions = [
            'action' => 'Temukan film-film penuh aksi dan adrenalin yang menegangkan dari berbagai negara. Kejar-kejaran, pertarungan epik, dan misi berbahaya menantimu.',
            'drama' => 'Selami kisah-kisah penuh emosi dan intrik yang menyentuh hati. Jelajahi berbagai sisi kehidupan manusia melalui film drama terbaik.',
            'comedy' => 'Lepaskan penat dengan tawa! Nikmati pilihan film komedi paling lucu yang siap menghibur hari-harimu.',
            'romance' => 'Rasakan kehangatan cinta melalui kisah romantis yang manis, mengharukan, dan tak terlupakan.',
            'horror' => 'Uji keberanianmu dengan koleksi film horor paling menyeramkan yang akan membuatmu merinding.',
            'thriller' => 'Penuh misteri dan ketegangan. Pecahkan teka-teki dan rasakan sensasi berdebar di setiap adegannya.'
        ];

        // Format nama kategori agar rapi (misal: "action" menjadi "Action")
        $categoryName = ucfirst(strtolower($categoryName));
        $description = $descriptions[strtolower($categoryName)] ?? "Jelajahi kumpulan film {$categoryName} terbaik, terpopuler, dan terbaru pilihan kami.";

        // Jika bukan kategori 'Semua', saring data berdasarkan genre
        if (strtolower($categoryName) !== 'semua') {
            $query->where('category', 'like', "%{$categoryName}%");
        }

        $totalMovies = $query->count();
        
        // Ambil film populer khusus untuk kategori ini (Rating Tertinggi)
        $popularMovies = (clone $query)->orderBy('rating', 'desc')->take(10)->get();
        
        // Ambil semua film untuk grid bawah (Dengan Pagination)
        $allMovies = (clone $query)->orderBy('title', 'asc')->paginate(18);

        return view('movies.category', compact('categoryName', 'description', 'totalMovies', 'popularMovies', 'allMovies'));
    }

}