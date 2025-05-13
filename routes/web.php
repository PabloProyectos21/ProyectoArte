<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentRatingController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\PremiumController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\PublicationRatingController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;


Route::get('/', function () {
    return view('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
Route::get('/explore', [ExploreController::class, 'index'])->name('explore');
Route::get('/publications/{id}', [PublicationController::class, 'show'])->name('publications.show');
Route::get('/explore-users', [UserController::class, 'explore'])->name('users.explore');
Route::get('/profile/{user}', [UserController::class, 'show'])->name('profile.view');
Route::get('/users/{id}/profile', [UserController::class, 'view'])->name('profile.view');
Route::get('/users/{user}', [UserController::class, 'show'])->name('profile.view');







Route::middleware('auth')->group(function () {
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/follow/{user}', [FollowController::class, 'toggle'])->name('follow.toggle');
    Route::post('/publications/{publication}/like', [PublicationRatingController::class, 'toggleLike'])
        ->name('publications.toggleLike');
    Route::post('/publications/{publication}/like', [PublicationRatingController::class, 'toggleLike'])
        ->name('publications.toggleLike');
    Route::post('/publications/{publication}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    Route::post('/comments/{comment}/like', [CommentController::class, 'toggleLike']);
    Route::post('/publications/{publication}/favorite', [PublicationController::class, 'toggleFavorite'])->name('publications.favorite');
    Route::get('/premium', [PremiumController::class, 'index'])->name('premium');
    Route::post('/premium/subscribe', [PremiumController::class, 'subscribe'])->name('premium.subscribe');
    Route::post('/premium/cancel', [PremiumController::class, 'cancel'])->name('premium.cancel');



});

Route::middleware(['auth', 'is_admin'])->group(function () {


    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'listUsers'])->name('admin.users');
    Route::get('/admin/publications', [AdminController::class, 'listPublications'])->name('admin.publications');
    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    Route::delete('/admin/publications/{id}', [AdminController::class, 'deletePublication'])->name('admin.publications.delete');
    Route::get('/admin-test', [AdminController::class, 'index']);


});

require __DIR__.'/auth.php';
