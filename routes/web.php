<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LabelController;
use Illuminate\Support\Facades\Route;

// Landing Page
Route::get('/', function () {
    return view('welcome');
});

// Dashboard - Hanya untuk user yang sudah login & terverifikasi
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Group Middleware: Hanya untuk user yang sudah login
Route::middleware('auth')->group(function () {

    // Profile Routes
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    // Tasks (To-Do List)
    Route::resource('task', TaskController::class)->except(['show']);

    // Categories (Kategori untuk tugas)
    Route::resource('category', CategoryController::class)->except(['show']);

    // Labels (Label atau tag untuk tugas)
    Route::resource('label', LabelController::class)->except(['show']);
});

// Load Routes dari Breeze
require __DIR__.'/auth.php';