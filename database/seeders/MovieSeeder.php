<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Movie;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $movies = [
            // ==========================================
            // 1. DATA HERO BANNER (TAMPIL DI ATAS)
            // ==========================================
            [
                'imdb_id' => 'tt1132285',
                'title' => '(500) Days of Summer',
                'description' => 'Ini bukanlah sebuah kisah cinta, melainkan kisah tentang cinta. Seorang pria bernama Tom jatuh hati pada Summer, wanita yang sama sekali tidak percaya pada konsep cinta sejati.',
                'rating' => 7.7,
                'year' => 2009,
                'age_rating' => '13+',
                'category' => 'Drama',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1536440136628-849c177e76a1?w=600&auto=format&fit=crop&q=60',
                'banner_url' => 'https://images.unsplash.com/photo-1489599849927-2ee91cede3ba?w=1600&auto=format&fit=crop&q=80',
                'is_hero' => true,
            ],
            [
                'imdb_id' => 'tt0468569',
                'title' => 'The Dark Knight',
                'description' => 'Ketika ancaman yang dikenal sebagai The Joker muncul dari masa lalunya, ia menyebarkan malapetaka dan kekacauan di kota Gotham. Batman harus menerima salah satu ujian psikologis dan fisik terbesar untuk melawan ketidakadilan.',
                'rating' => 9.0,
                'year' => 2008,
                'age_rating' => '13+',
                'category' => 'Action',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1478760329108-5c3ed9d495a0?w=600&auto=format&fit=crop&q=60',
                'banner_url' => 'https://images.unsplash.com/photo-1509198397868-475647b2a1e5?w=1600&auto=format&fit=crop&q=80',
                'is_hero' => true,
            ],
            [
                'imdb_id' => 'tt0816692',
                'title' => 'Interstellar',
                'description' => 'Di masa depan ketika Bumi tidak lagi mampu menopang kehidupan, sekelompok penjelajah melintasi lubang cacing di luar angkasa demi memastikan kelangsungan hidup umat manusia.',
                'rating' => 8.7,
                'year' => 2014,
                'age_rating' => '13+',
                'category' => 'Sci-Fi',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=600&auto=format&fit=crop&q=60',
                'banner_url' => 'https://images.unsplash.com/photo-1446776811953-b23d57bd21aa?w=1600&auto=format&fit=crop&q=80',
                'is_hero' => true,
            ],

            // ==========================================
            // 2. DATA KATEGORI DRAMA (10 Item)
            // ==========================================
            [
                'imdb_id' => 'tt6439720', 'title' => 'Dilan 1990', 'description' => 'Kisah asmara remaja di Bandung tahun 1990.', 'rating' => 7.1, 'year' => 2018, 'age_rating' => '13+', 'category' => 'Drama', 
                'thumbnail_url' => 'https://images.unsplash.com/photo-1518156677180-95a2893f3e9f?w=600&auto=format&fit=crop&q=60', 'is_hero' => false
            ],
            [
                'imdb_id' => 'tt9812345', 'title' => 'Dilan 1991', 'description' => 'Kelanjutan kisah cinta Dilan dan Milea.', 'rating' => 6.6, 'year' => 2019, 'age_rating' => '13+', 'category' => 'Drama', 
                'thumbnail_url' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=600&auto=format&fit=crop&q=60', 'is_hero' => false
            ],
            [
                'imdb_id' => 'tt1122334', 'title' => 'Yang Tak Pernah Berdenting', 'description' => 'Drama tentang rahasia keluarga.', 'rating' => 7.5, 'year' => 2021, 'age_rating' => '13+', 'category' => 'Drama', 
                'thumbnail_url' => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=600&auto=format&fit=crop&q=60', 'is_hero' => false
            ],
            [
                'imdb_id' => 'tt7456321', 'title' => 'Susah Sinyal', 'description' => 'Liburan ibu dan anak untuk merekatkan hubungan.', 'rating' => 6.9, 'year' => 2017, 'age_rating' => '13+', 'category' => 'Drama', 
                'thumbnail_url' => 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?w=600&auto=format&fit=crop&q=60', 'is_hero' => false
            ],
            [
                'imdb_id' => 'tt1170881', 'title' => 'Laskar Pelangi', 'description' => 'Perjuangan anak-anak Belitung untuk bersekolah.', 'rating' => 8.0, 'year' => 2008, 'age_rating' => 'SU', 'category' => 'Drama', 
                'thumbnail_url' => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=600&auto=format&fit=crop&q=60', 'is_hero' => false
            ],
            [
                'imdb_id' => 'tt2563816', 'title' => 'Habibie & Ainun', 'description' => 'Perjalanan cinta Presiden ke-3 RI.', 'rating' => 7.6, 'year' => 2012, 'age_rating' => '13+', 'category' => 'Drama', 
                'thumbnail_url' => 'https://images.unsplash.com/photo-1518621736915-f3b1c41bfd00?w=600&auto=format&fit=crop&q=60', 'is_hero' => false
            ],
            [
                'imdb_id' => 'tt0307904', 'title' => 'Ada Apa dengan Cinta?', 'description' => 'Kisah romansa klasik remaja SMA.', 'rating' => 7.7, 'year' => 2002, 'age_rating' => '13+', 'category' => 'Drama', 
                'thumbnail_url' => 'https://images.unsplash.com/photo-1522869635100-9f4c5e86faa3?w=600&auto=format&fit=crop&q=60', 'is_hero' => false
            ],
            [
                'imdb_id' => 'tt8427776', 'title' => 'Keluarga Cemara', 'description' => 'Sebuah keluarga yang harus bertahan hidup di desa.', 'rating' => 7.9, 'year' => 2018, 'age_rating' => 'SU', 'category' => 'Drama', 
                'thumbnail_url' => 'https://images.unsplash.com/photo-1600880292203-757bb62b4baf?w=600&auto=format&fit=crop&q=60', 'is_hero' => false
            ],
            [
                'imdb_id' => 'tt10166292', 'title' => 'Dua Garis Biru', 'description' => 'Konsekuensi dari cinta monyet remaja.', 'rating' => 7.9, 'year' => 2019, 'age_rating' => '13+', 'category' => 'Drama', 
                'thumbnail_url' => 'https://images.unsplash.com/photo-1500643752441-4cb9fd03164a?w=600&auto=format&fit=crop&q=60', 'is_hero' => false
            ],
            [
                'imdb_id' => 'tt20311270', 'title' => 'Ngeri-Ngeri Sedap', 'description' => 'Konflik keluarga Batak yang mengharukan.', 'rating' => 8.0, 'year' => 2022, 'age_rating' => '13+', 'category' => 'Drama', 
                'thumbnail_url' => 'https://images.unsplash.com/photo-1542204165-65bf26472b9b?w=600&auto=format&fit=crop&q=60', 'is_hero' => false
            ],

            // ==========================================
            // 3. DATA KATEGORI ACTION (10 Item)
            // ==========================================
            [
                'imdb_id' => 'tt9646326', 'title' => 'Mission: Impossible', 'description' => 'Misi berbahaya Ethan Hunt.', 'rating' => 8.1, 'year' => 2025, 'age_rating' => '13+', 'category' => 'Action', 
                'thumbnail_url' => 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?w=600&auto=format&fit=crop&q=60', 'is_hero' => false
            ],
            [
                'imdb_id' => 'tt1234500', 'title' => 'Justice League', 'description' => 'Pahlawan super berkumpul.', 'rating' => 6.1, 'year' => 2017, 'age_rating' => '13+', 'category' => 'Action', 
                'thumbnail_url' => 'https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?w=600&auto=format&fit=crop&q=60', 'is_hero' => false
            ],
            [
                'imdb_id' => 'tt0770828', 'title' => 'Man of Steel', 'description' => 'Kisah asal-usul Superman.', 'rating' => 7.1, 'year' => 2013, 'age_rating' => '13+', 'category' => 'Action', 
                'thumbnail_url' => 'https://images.unsplash.com/photo-1635805737707-575885ab0820?w=600&auto=format&fit=crop&q=60', 'is_hero' => false
            ],
            [
                'imdb_id' => 'tt1899353', 'title' => 'The Raid: Redemption', 'description' => 'Serbuan pasukan khusus ke markas gembong narkoba.', 'rating' => 7.6, 'year' => 2011, 'age_rating' => '17+', 'category' => 'Action', 
                'thumbnail_url' => 'https://images.unsplash.com/photo-1505506874110-6a7a6099837b?w=600&auto=format&fit=crop&q=60', 'is_hero' => false
            ],
            [
                'imdb_id' => 'tt2911666', 'title' => 'John Wick', 'description' => 'Balas dendam seorang mantan pembunuh bayaran.', 'rating' => 7.4, 'year' => 2014, 'age_rating' => '17+', 'category' => 'Action', 
                'thumbnail_url' => 'https://images.unsplash.com/photo-1445280471656-618bf9abc281?w=600&auto=format&fit=crop&q=60', 'is_hero' => false
            ],
            [
                'imdb_id' => 'tt1392190', 'title' => 'Mad Max: Fury Road', 'description' => 'Kejar-kejaran maut di gurun pasca apokaliptik.', 'rating' => 8.1, 'year' => 2015, 'age_rating' => '17+', 'category' => 'Action', 
                'thumbnail_url' => 'https://images.unsplash.com/photo-1533613220915-609f661a6fe1?w=600&auto=format&fit=crop&q=60', 'is_hero' => false
            ],
            [
                'imdb_id' => 'tt1375666', 'title' => 'Inception', 'description' => 'Mencuri rahasia dari dalam mimpi target.', 'rating' => 8.8, 'year' => 2010, 'age_rating' => '13+', 'category' => 'Action', 
                'thumbnail_url' => 'https://images.unsplash.com/photo-1620121692029-d088224ddc74?w=600&auto=format&fit=crop&q=60', 'is_hero' => false
            ],
            [
                'imdb_id' => 'tt0133093', 'title' => 'The Matrix', 'description' => 'Dunia simulasi dan pemberontakan manusia.', 'rating' => 8.7, 'year' => 1999, 'age_rating' => '17+', 'category' => 'Action', 
                'thumbnail_url' => 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?w=600&auto=format&fit=crop&q=60', 'is_hero' => false
            ],
            [
                'imdb_id' => 'tt4154796', 'title' => 'Avengers: Endgame', 'description' => 'Pertarungan terakhir melawan Thanos.', 'rating' => 8.4, 'year' => 2019, 'age_rating' => '13+', 'category' => 'Action', 
                'thumbnail_url' => 'https://images.unsplash.com/photo-1561149877-84d268ba65b8?w=600&auto=format&fit=crop&q=60', 'is_hero' => false
            ],
            [
                'imdb_id' => 'tt0172495', 'title' => 'Gladiator', 'description' => 'Jenderal Romawi yang menjadi gladiator.', 'rating' => 8.5, 'year' => 2000, 'age_rating' => '17+', 'category' => 'Action', 
                'thumbnail_url' => 'https://images.unsplash.com/photo-1614594619421-4d1cc415d862?w=600&auto=format&fit=crop&q=60', 'is_hero' => false
            ]
        ];

        // Loop untuk memasukkan data ke database secara otomatis
        foreach ($movies as $movieData) {
            Movie::create($movieData);
        }
    }
}