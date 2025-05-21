<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommercialController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\PremiumController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\PublicationRatingController;
use App\Http\Controllers\UserController;
use App\Models\Commercial;
use Illuminate\Support\Facades\Route;






Route::middleware('auth')->group(function () {
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/follow/{user}', [FollowController::class, 'toggle'])->name('follow.toggle');

    Route::get('/publications/create', [PublicationController::class, 'create'])->name('publications.create');
    Route::post('/publications/{publication}/like', [PublicationRatingController::class, 'toggleLike'])
        ->name('publications.toggleLike');
    Route::post('/publications/{publication}/like', [PublicationRatingController::class, 'toggleLike'])
        ->name('publications.toggleLike');
    Route::post('/publications/{publication}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/publications/{publication}/edit', [PublicationController::class, 'edit'])->name('publications.edit');

    Route::put('/publications/{publication}', [PublicationController::class, 'update'])->name('publications.update');

    Route::delete('/publications/{publication}', [PublicationController::class, 'destroy'])->name('publications.destroy');


    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::post('/comments/{comment}/like', [CommentController::class, 'toggleLike']);
    Route::post('/publications/{publication}/favorite', [PublicationController::class, 'toggleFavorite'])->name('publications.favorite');

    Route::get('/premium', [PremiumController::class, 'index'])->name('premium');
    Route::post('/premium/subscribe', [PremiumController::class, 'subscribe'])->name('premium.subscribe');
    Route::post('/premium/cancel', [PremiumController::class, 'cancel'])->name('premium.cancel');

    Route::get('/chats', [ChatController::class, 'index'])->name('chats.index');
    Route::get('/chats/{chat}', [ChatController::class, 'show'])->name('chats.show');
    Route::post('/chats', [ChatController::class, 'store'])->name('chats.store');

    Route::post('/chats/{chat}/message', [ChatController::class, 'sendMessage'])->name('chats.message');
    Route::post('/chats/create', [ChatController::class, 'create'])->name('chats.create');
    Route::post('/chats/create-or-redirect', [ChatController::class, 'createOrRedirect'])->name('chats.createOrRedirect');
    Route::get('/users/search', [App\Http\Controllers\UserController::class, 'searchByUsername'])->name('users.autocomplete');

});


Route::post('/publications', [PublicationController::class, 'store'])->name('publications.store');



Route::get('/', function () {
    $commercial = Commercial::inRandomOrder()->with('company')->first();
    return view('dashboard', compact('commercial'));
});

Route::get('/dashboard', function () {
    $commercial = Commercial::inRandomOrder()->with('company')->first();
    return view('dashboard', compact('commercial'));
})->name('dashboard');
Route::get('/explore', [ExploreController::class, 'index'])->name('explore');
Route::get('/publications/{id}', [PublicationController::class, 'show'])->name('publications.show');
Route::get('/explore-users', [UserController::class, 'explore'])->name('users.explore');

Route::get('/users/{user}', [UserController::class, 'show'])->name('profile.view');








Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'listUsers'])->name('admin.users');

    Route::get('/admin/publications', [AdminController::class, 'listPublications'])->name('admin.publications');
    Route::delete('/admin/publications/{id}', [AdminController::class, 'deletePublication'])->name('admin.publications.delete');

    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    Route::get('/admin/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/admin/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');

    Route::get('/admin/commercials/create', [AdminController::class, 'createCommercial'])->name('admin.commercials.create');
    Route::post('/admin/commercials', [AdminController::class, 'storeCommercial'])->name('admin.commercials.store');

    Route::get('/admin/companies/create', [AdminController::class, 'createCompany'])->name('admin.companies.create');
    Route::post('/admin/companies', [AdminController::class, 'storeCompany'])->name('admin.companies.store');

    Route::get('/admin/companies', [AdminController::class, 'listCompanies'])->name('admin.companies');
    Route::delete('/admin/companies/{id}', [AdminController::class, 'deleteCompany'])->name('admin.companies.delete');


    Route::get('/admin/companies/{id}/edit', [AdminController::class, 'editCompany'])->name('admin.companies.edit');
    Route::put('/admin/companies/{id}', [AdminController::class, 'updateCompany'])->name('admin.companies.update');

    // Ruta para la lista de anuncios comerciales en el panel de administración
    Route::get('/admin/commercials', [AdminController::class, 'listCommercials'])->name('admin.commercials');
    Route::get('/admin/commercials/{commercial}/edit', [CommercialController::class, 'edit'])->name('admin.commercials.edit');
    Route::put('/admin/commercials/{commercial}', [CommercialController::class, 'update'])->name('admin.commercials.update');
    Route::delete('/admin/commercials/{commercial}', [CommercialController::class, 'destroy'])->name('admin.commercials.delete');


});







require __DIR__.'/auth.php';
