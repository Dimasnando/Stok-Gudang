<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('Barang')->group(function () {

    // Baju
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/baju', [App\Http\Controllers\BajuController::class, 'index'])->name('get.baju');
        Route::get('/baju/tambah', [App\Http\Controllers\BajuController::class, 'tambah'])->name('get.tambah.baju');
        Route::post('/baju/tambah/proses', [App\Http\Controllers\BajuController::class, 'proses_tambah'])->name('post.proses-tambah.baju');
        Route::get('/baju/detail/{id}', [App\Http\Controllers\BajuController::class, 'detail'])->name('get.detail.baju');
        Route::get('/baju/ubah/{id}', [App\Http\Controllers\BajuController::class, 'ubah'])->name('get.ubah.baju');
        Route::patch('/baju/ubah/proses/{id}', [App\Http\Controllers\BajuController::class, 'proses_ubah'])->name('post.proses-ubah.baju');
        Route::delete('/baju/hapus/{id}', [App\Http\Controllers\BajuController::class, 'hapus'])->name('delete.baju');
    });


    // Pendiri
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/pendiri', [App\Http\Controllers\PendiriController::class, 'index'])->name('get.pendiri');
        Route::get('/pendiri/tambah', [App\Http\Controllers\PendiriController::class, 'tambah'])->name('get.tambah.pendiri');
        Route::post('/pendiri/tambah/proses', [App\Http\Controllers\PendiriController::class, 'proses_tambah'])->name('post.proses-tambah.pendiri');
        Route::get('/pendiri/detail/{id}', [App\Http\Controllers\PendiriController::class, 'detail'])->name('get.detail.pendiri');
        Route::get('/pendiri/ubah/{id}', [App\Http\Controllers\PendiriController::class, 'ubah'])->name('get.ubah.pendiri');
        Route::patch('/pendiri/ubah/proses/{id}', [App\Http\Controllers\PendiriController::class, 'proses_ubah'])->name('post.proses-ubah.pendiri');
        Route::delete('/pendiri/hapus/{id}', [App\Http\Controllers\PendiriController::class, 'hapus'])->name('delete.pendiri');
    });
});

// No Prefix and Middleware Auth & Verified
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/tentang', [App\Http\Controllers\HomeController::class, 'tentang'])->name('tentang');

    // Profile
    Route::get('/my-profile/{id}', [App\Http\Controllers\ProfileController::class, 'create'])->name('profile.home');
    Route::patch('/my-profile/{id}', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    // Get Files
    Route::get('/files/profile-picture/{namaFile}', [App\Http\Controllers\FilesController::class, 'showProfilePicture']);
});
