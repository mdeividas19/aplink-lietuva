<?php
use App\Http\Controllers\StoryMapController;
use App\Http\Controllers\StoryLikeController;
use App\Http\Controllers\StoryCommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\LocationsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MapController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;

Route::get('/', [CityController::class, 'index'])->name('main');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::delete('/stories/{story}/images/{image}', [StoryController::class, 'destroyImage'])->name('stories.images.destroy');
Route::resource('stories', StoryController::class);
Route::get('/stories/map/map', [StoryMapController::class, 'index'])->name('stories.map');

Route::resource('map', MapController::class);

Route::get('/contacts', function () {
    return view('contacts');
})->name('contacts');

Route::get('/locations/favorites', [LocationsController::class, 'Favorites'])->name('locations.favorites');
Route::resource('locations', LocationsController::class);
Route::post('/locations/{location}/replace-first-photo', [LocationsController::class, 'ReplaceFirstPhoto'])->name('locations.ReplaceFirstPhoto');
Route::post('/locations/{location}/add-photo', [LocationsController::class, 'AddMorePhotos'])->name('locations.AddMorePhotos');
Route::delete('/locations/{location}/delete-photo/{photoId}', [LocationsController::class, 'DeletePhoto'])->name('locations.DeletePhoto');
Route::post('/locations/{location}/favorite', [LocationsController::class, 'storeFavorite'])->name('locations.favorite.store');
Route::delete('/locations/{location}/favorite', [LocationsController::class, 'destroyFavorite'])->name('locations.favorite.destroy');

Route::get('/cities/{id}', [CityController::class, 'show'])->name('cities.show');

Route::get('/random-location', [LocationsController::class, 'getRandomLocation']);

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
    Route::post('/stories/{story}/like', [StoryLikeController::class, 'toggle'])->name('stories.like.toggle');

    Route::post('/locations/{location}/reviews', [ReviewController::class, 'store'])
    ->name('locations.reviews.store');
});

Route::middleware('can:isAdmin')->group(function(){
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users/{user}', [AdminController::class, 'editUser'])->name('admin.editUser');
    Route::patch('/admin/users/{user}', [AdminController::class, 'updateUser'])->name('admin.updateUser');

    Route::get('/admin/reviews', [AdminController::class, 'reviewIndex'])->name('admin.reviews');
    Route::get('/admin/reviews/{review}', [AdminController::class, 'editReview'])->name('admin.editReview');
    Route::patch('/admin/reviews/{review}', [AdminController::class, 'updateReview'])->name('admin.updateReview');

    Route::get('/admin/stories', [AdminController::class, 'storyIndex'])->name('admin.stories');
    Route::get('/admin/stories/{story}', [AdminController::class, 'editStory'])->name('admin.editStory');
    Route::patch('/admin/stories/{story}', [AdminController::class, 'updateStory'])->name('admin.updateStory');


});

require __DIR__.'/auth.php';
