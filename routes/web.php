<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\NewPasswordController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // con Route::resource se generan automaticamente las rutas para los métodos index, create, store, show, edit, update y destroy
    Route::middleware('auth')->group(function () {
        Route::resource('publicaciones', PostController::class);
    });
    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->middleware('guest')
        ->name('password.store');

});

require __DIR__ . '/auth.php';
