<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\Support\Facades\Http; 

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

    // Menampilkan halaman khusus pemutaran film
    public function watch($id)
    {
        // Tarik data film sekaligus data stream-nya jika ada
        $movie = Movie::with('stream')->findOrFail($id);

        return view('movies.watch', compact('movie'));
    }

    // 1. Fungsi AJAX untuk mencari di Database Lokal
    public function searchLocal(Request $request)
    {
        $query = $request->input('q');
        
        // Cari 5 film yang mirip dengan kata kunci
        $movies = Movie::where('title', 'like', "%{$query}%")
                       ->take(5)
                       ->get(['id', 'title', 'thumbnail_url', 'year', 'rating']); // Ambil kolom yang penting saja agar ringan
                       
        return response()->json($movies);
    }

    // 2. Fungsi saat tombol Enter ditekan (Mencari ke TMDB)
    public function searchTmdb(Request $request)
    {
        $query = $request->input('q');
        $apiKey = env('TMDB_API_KEY');
        $tmdbMovies = [];

        if ($query) {
            $response = Http::get("https://api.themoviedb.org/3/search/movie", [
                'api_key' => $apiKey,
                'query' => $query,
                'language' => 'id-ID',
            ]);

            if ($response->successful()) {
                $tmdbMovies = $response->json()['results'];
            }
        }

        return view('movies.search', compact('tmdbMovies', 'query'));
    }

    // Menambahkan film dari TMDB ke database lokal saat melakukan pencarian
    public function importFromTmdb($tmdb_id)
    {
        //Cek apakah film sudah ada di database lokal kita (menggunakan kolom imdb_id)
        $movie = Movie::where('imdb_id', $tmdb_id)->first();

        if ($movie) {
            // Jika film SUDAH ADA, langsung arahkan ke halaman detail lokal
            return redirect()->route('movies.show', $movie->id);
        }

        //Jika BELUM ADA, tarik data lengkapnya dari TMDB
        $apiKey = env('TMDB_API_KEY');
        $response = Http::get("https://api.themoviedb.org/3/movie/{$tmdb_id}", [
            'api_key' => $apiKey,
            'language' => 'id-ID',
        ]);

        if ($response->successful()) {
            $tmdbData = $response->json();

            // Ambil genre pertama (jika ada) untuk dimasukkan ke kategori
            $category = 'Lainnya';
            if (!empty($tmdbData['genres'])) {
                $category = $tmdbData['genres'][0]['name'];
            }

            // Tentukan batas usia sederhana
            $ageRating = $tmdbData['adult'] ? '18+' : '13+';

            //Simpan (Insert) ke Database Lokal kita
            $movie = Movie::create([
                'title' => $tmdbData['title'],
                'imdb_id' => $tmdbData['id'],
                'description' => $tmdbData['overview'] ?: 'Sinopsis belum tersedia untuk film ini.',
                'year' => !empty($tmdbData['release_date']) ? substr($tmdbData['release_date'], 0, 4) : 'N/A',
                'rating' => $tmdbData['vote_average'],
                'category' => $category,
                'age_rating' => $ageRating,
                'thumbnail_url' => $tmdbData['poster_path'] ? "https://image.tmdb.org/t/p/w500" . $tmdbData['poster_path'] : "https://via.placeholder.com/300x450",
                'banner_url' => $tmdbData['backdrop_path'] ? "https://image.tmdb.org/t/p/original" . $tmdbData['backdrop_path'] : "https://via.placeholder.com/1920x1080",
            ]);

            //Setelah berhasil disimpan, arahkan pengguna ke halaman detail film tersebut
            return redirect()->route('movies.show', $movie->id);
        }

        // Jika terjadi kegagalan dari TMDB
        return redirect()->back()->with('error', 'Gagal mengambil data dari TMDB.');
    }
}