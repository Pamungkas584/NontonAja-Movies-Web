<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\WatchlistController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/login', [AuthController::class, 'login'])->name('login');

// Route khusus untuk autentikasi dan sesi pengguna
Route::middleware('web')->group(function () {
    // Rute Login Google Socialite
    Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
    Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);
    
    // Rute Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Rute khusus sudah login (Hanya bisa diakses jika sudah login)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/name', [ProfileController::class, 'updateName'])->name('profile.update');
    Route::get('/profile/vip', [ProfileController::class, 'vip'])->name('profile.vip');
    Route::post('/movies/{movie}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::post('/watchlist/toggle/{movie}', [WatchlistController::class, 'toggle'])->name('watchlist.toggle');
    Route::get('/daftar-saya', [WatchlistController::class, 'index'])->name('watchlist.index');
    Route::get('/nonton/{id}', [App\Http\Controllers\MovieController::class, 'watch'])->name('movies.watch');
});

Route::get('/film', [MovieController::class, 'index'])->name('movies.index');

// Rute untuk halaman spesifik kategori (Baru)
Route::get('/film/kategori/{category}', [MovieController::class, 'category'])->name('movies.category');

Route::get('/movie/{id}', [MovieController::class, 'show'])->name('movies.show');

