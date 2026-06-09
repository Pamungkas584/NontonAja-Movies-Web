<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Movie;

class FetchTmdbMovies extends Command
{
    // terminal Command
    protected $signature = 'tmdb:fetch';

    // debug
    protected $description = 'Mengambil data film Action dan Drama populer dari TMDB API';

    public function handle()
    {
        $apiKey = config('services.tmdb.key');

        if (!$apiKey) {
            $this->error('TMDB API Key tidak ditemukan. Pastikan sudah diisi di .env');
            return;
        }

        // Pemetaan Genre ID dari TMDB
        $genres = [
            'Action' => 28,
            'Drama' => 18
        ];

        $this->info('Memulai penarikan data dari tmdb');

        foreach ($genres as $categoryName => $genreId) {
            $this->info("Mengambil film populer untuk kategori: {$categoryName}php artisan tmdb:fetch");

            // Melakukan request ke endpoint 'discover' milik TMDB
            $response = Http::get("https://api.themoviedb.org/3/discover/movie", [
                'api_key' => $apiKey,
                'with_genres' => $genreId,
                'language' => 'id-ID', // Meminta data dalam Bahasa Indonesia
                'sort_by' => 'popularity.desc', // Urutkan dari yang paling populer
                'page' => 1 // Ambil halaman pertama (20 film per halaman)
            ]);

            if ($response->successful()) {
                $movies = $response->json()['results'];

                foreach ($movies as $data) {
                    // Skip film jika tidak memiliki poster atau backdrop (agar tampilan web tidak rusak)
                    if (empty($data['poster_path']) || empty($data['backdrop_path'])) {
                        continue;
                    }

                    // Ambil tahun rilis dari format YYYY-MM-DD
                    $year = isset($data['release_date']) ? (int) substr($data['release_date'], 0, 4) : null;
                    
                    // TMDB hanya memberikan path relatif, kita harus menambahkan Base URL gambar
                    $posterUrl = "https://image.tmdb.org/t/p/w500" . $data['poster_path'];
                    $backdropUrl = "https://image.tmdb.org/t/p/w1280" . $data['backdrop_path']; // Kualitas HD untuk banner

                    Movie::updateOrCreate(
                        ['imdb_id' => (string) $data['id']], // TMDB menggunakan ID angka, kita simpan di kolom imdb_id yang sudah ada
                        [
                            'title' => $data['title'],
                            'description' => $data['overview'],
                            'rating' => $data['vote_average'],
                            'year' => $year,
                            'age_rating' => $data['adult'] ? '18+' : '13+',
                            'category' => $categoryName,
                            'thumbnail_url' => $posterUrl,
                            'banner_url' => $backdropUrl, // Ini akan membuat Hero Banner kita sangat cantik!
                            'is_hero' => false, // Default false
                        ]
                    );

                    $this->line(" - Tersimpan: {$data['title']}");
                }
            } else {
                $this->error("Gagal terhubung ke API TMDB untuk kategori {$categoryName}");
            }
        }

        $this->info('Proses penarikan data selesai! Ratusan film siap ditampilkan.');
    }
}