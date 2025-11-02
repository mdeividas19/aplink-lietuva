<?php

use App\Http\Controllers\StoryCommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\LocationsController;
use App\Http\Controllers\adminController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CityController::class, 'index'])->name('main');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::resource('stories', StoryController::class);

Route::get('/contacts', function () {
    return view('contacts');
})->name('contacts');

Route::get('/locations', [LocationsController::class, 'index'])->name('locations.index');
Route::get('/locations/{id}', [LocationsController::class, 'show'])->name('locations.show');

Route::get('/cities/{id}', [CityController::class, 'show'])->name('cities.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::post('/stories/{story}/comments', [StoryCommentController::class, 'store'])->name('stories.comments.store');
    Route::patch('/comments/{comment}', [StoryCommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [StoryCommentController::class, 'destroy'])->name('comments.destroy');
});

Route::get('/admin', [adminController::class, 'index'])->name('admin.dashboard');

require __DIR__.'/auth.php';
