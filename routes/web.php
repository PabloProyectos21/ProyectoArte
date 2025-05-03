<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\PublicationRatingController;
use App\Http\Controllers\PublicationController;
use \App\Http\Controllers\ExploreController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
Route::get('/explore', [ExploreController::class, 'index'])->name('explore');
Route::get('/publications/{id}', [PublicationController::class, 'show'])->name('publications.show');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/follow/{user}', [FollowController::class, 'toggle'])->name('follow.toggle')->middleware('auth');
    Route::post('/publications/{publication}/like', [PublicationRatingController::class, 'toggleLike'])
        ->middleware('auth')
        ->name('publications.toggleLike');


});

require __DIR__.'/auth.php';
