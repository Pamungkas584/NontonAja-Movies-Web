<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Movie;

class FetchTmdbGenres extends Command
{
    // Nama perintah yang akan kita jalankan di terminal nanti
    protected $signature = 'tmdb:fetch-genres';

    protected $description = 'Mengambil 50 film dari TMDB untuk setiap kategori genre';

    public function handle()
    {
        // Pastikan kamu sudah menaruh TMDB_API_KEY di file .env
        $apiKey = env('TMDB_API_KEY'); 

        if (!$apiKey) {
            $this->error('TMDB_API_KEY tidak ditemukan di file .env!');
            return;
        }

        // Daftar ID Genre resmi dari TMDB sesuai desainmu
        $genres = [
            'Action' => 28,
            'Comedy' => 35,
            'Horror' => 27,
            'Fantasy' => 14,
            'Thriller' => 53,
            'Adventure' => 12,
            'Drama' => 18,
            'Sci-Fi' => 878,
            'Mystery' => 964,
            'Romance' => 1074,
        ];

        $this->info("Memulai proses pengambilan film dari TMDB...\n");

        foreach ($genres as $genreName => $genreId) {
            $this->info("Mengambil data untuk genre: {$genreName}...");
            $moviesFetched = 0;
            $page = 10;

            // Terus ulangi ke halaman berikutnya sampai terkumpul 50 film
            while ($moviesFetched < 50) {
                // Tembak API TMDB menggunakan Laravel HTTP Client
                $response = Http::get("https://api.themoviedb.org/3/discover/movie", [
                    'api_key' => $apiKey,
                    'with_genres' => $genreId,
                    'page' => $page,
                    'language' => 'id-ID', // Ambil data berbahasa Indonesia jika tersedia
                    'sort_by' => 'popularity.desc', // Urutkan dari yang paling populer
                ]);

                if ($response->successful()) {
                    $movies = $response->json()['results'];

                    foreach ($movies as $movieData) {
                        // Hentikan proses jika sudah mencapai 50 film
                        if ($moviesFetched >= 50) break;

                        // Cegah penyimpanan data yang tidak punya poster/banner
                        if (empty($movieData['poster_path']) || empty($movieData['backdrop_path'])) {
                            continue; 
                        }

                        // Simpan atau perbarui data di database
                        // Menggunakan updateOrCreate untuk mencegah duplikat film yang sama
                        Movie::updateOrCreate(
                            ['title' => $movieData['title']], // Kolom patokan (mencari judul yang sama)
                            [
                                'imdb_id' => (string) $movieData['id'],
                                'description' => $movieData['overview'] ?: 'Sinopsis belum tersedia.',
                                'year' => !empty($movieData['release_date']) ? substr($movieData['release_date'], 0, 4) : 'N/A',
                                'rating' => $movieData['vote_average'],
                                'thumbnail_url' => "https://image.tmdb.org/t/p/w500" . $movieData['poster_path'],
                                'banner_url' => "https://image.tmdb.org/t/p/original" . $movieData['backdrop_path'],
                                'category' => $genreName,
                                'age_rating' => '13+', // Default statis, TMDB butuh request terpisah untuk age rating
                            ]
                        );

                        $moviesFetched++;
                    }
                } else {
                    $this->error("Gagal terhubung ke TMDB pada halaman {$page} untuk genre {$genreName}");
                    break; 
                }

                $page++; // Lanjut ke halaman 2, 3, dst.
            }

            $this->line("{$moviesFetched} film {$genreName} berhasil disimpan.\n");
        }

        $this->info("Selesai! Database kamu sekarang terisi ratusan film baru.");
    }
}