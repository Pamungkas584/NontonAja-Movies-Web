<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\WatchlistController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SubscriptionController;


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
    // Menampilkan Halaman Checkout
    Route::get('/subscribe/checkout/{package}', [App\Http\Controllers\SubscriptionController::class, 'checkoutPage'])->name('subscribe.checkout.page');
    Route::post('/subscribe/process', [App\Http\Controllers\SubscriptionController::class, 'processPayment'])->name('subscribe.process');
});

Route::get('/film', [MovieController::class, 'index'])->name('movies.index');

// Rute untuk halaman spesifik kategori (Baru)
Route::get('/film/kategori/{category}', [MovieController::class, 'category'])->name('movies.category');
Route::get('/movie/{id}', [MovieController::class, 'show'])->name('movies.show');

// searching 
Route::get('/search/local', [App\Http\Controllers\MovieController::class, 'searchLocal'])->name('search.local');
Route::get('/search', [App\Http\Controllers\MovieController::class, 'searchTmdb'])->name('search.tmdb');
// import hasil searching yang tidak ada di database lokal
Route::get('/movie/import/{tmdb_id}', [App\Http\Controllers\MovieController::class, 'importFromTmdb'])->name('movies.import');


// Rute khusus Admin (Hanya bisa diakses oleh user yang memiliki role 'admin')
Route::prefix('admin')->middleware(['web', 'auth', 'role:admin'])->group(function () {
    // Menampilkan daftar film
    Route::get('/movies', [AdminController::class, 'index'])->name('admin.movies.index');

    // Menampilkan halaman form tambah film
    Route::get('/movies/create', [AdminController::class, 'create'])->name('admin.movies.create');
    
    // Memproses penyimpanan data film baru ke database
    Route::post('/movies', [AdminController::class, 'store'])->name('admin.movies.store');
    
    // Menampilkan halaman form edit film (membawa data film lama)
    Route::get('/movies/{id}/edit', [AdminController::class, 'edit'])->name('admin.movies.edit');
    
    // Memproses pembaruan data film di database
    Route::put('/movies/{id}', [AdminController::class, 'update'])->name('admin.movies.update');

    // hapus film
    Route::delete('/movies/{id}', [AdminController::class, 'destroy'])->name('admin.movies.destroy');
});

// Rute Webhook Midtrans 
Route::post('/midtrans/callback', [SubscriptionController::class, 'notificationHandler']);