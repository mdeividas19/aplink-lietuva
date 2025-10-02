<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\StoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CityController::class, 'index'])->name('main');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::resource('stories', StoryController::class);

Route::get('/contacts', function () {
    return view('contacts');
})->name('contacts');

Route::get('/cities/{id}', [CityController::class, 'show'])->name('cities.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
