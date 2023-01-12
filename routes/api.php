<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Auth
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);
Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register']);

//  Logout
Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout'])->middleware('auth:sanctum');

// Prefix Master
Route::prefix('Barang')->group(function () {

    // Middleware Auth Sanctum
    Route::middleware(['auth:sanctum'])->group(function () {

        Route::get('/baju', [App\Http\Controllers\API\BajuController::class, 'index']);
        Route::post('/baju/tambah', [App\Http\Controllers\API\BajuController::class, 'tambah']);
        Route::patch('/baju/ubah/{id}', [App\Http\Controllers\API\BajuController::class, 'ubah']);
        Route::delete('/baju/hapus/{id}', [App\Http\Controllers\API\BajuController::class, 'hapus']);
    });
});
