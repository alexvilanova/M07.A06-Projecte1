<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProfileController,
    MailController,
    FileController,
    PlacesController,
    PostController,
    CommentController,
    LanguageController
};
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Rutas Públicas
|--------------------------------------------------------------------------
*/
Route::get('/', function (Request $request) {
    $message = 'Loading welcome page';
    Log::info($message);
    $request->session()->flash('info', $message);
    return view('welcome');
});

Route::get('mail/test', [MailController::class, 'test']);
Route::get('/language/{locale}', [LanguageController::class, 'language'])->name('language');

require __DIR__.'/auth.php';

Route::get('/build/assets/{path}', function (Request $request, $path) {
    $filepath = asset('build/assets/'. $path);
    Log::info($filepath);
    return response()->file($filepath);
});

/*
|--------------------------------------------------------------------------
| Rutas Autenticadas
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // Dashboard & Verificación
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('verified')->name('dashboard');

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Archivos
    Route::resource('files', FileController::class);

    // Posts
    Route::resource('posts', PostController::class);
    Route::post('/posts/{post}/likes', [PostController::class, 'like'])->name('posts.likes');
    Route::delete('/posts/{post}/likes', [PostController::class, 'unlike'])->name('posts.unlike');
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('posts.comments');
    Route::delete('/posts/{post}/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::get('posts.search', 'App\Http\Controllers\PostController@search')->name('posts.search');

    // Lugares
    Route::resource('places', PlacesController::class);
    Route::get('places.search', 'App\Http\Controllers\PlacesController@search')->name('places.search');
    Route::post('places/{place}/favs', [PlacesController::class, 'favorite'])->name('places.favorite')->middleware('can:like,place');
    Route::delete('places/{place}/favs', [PlacesController::class, 'unfavorite'])->name('places.unfavorite')->middleware('can:like,place');

    // Secciones "Acerca de"
    Route::view('/about', 'about.index')->name('about.index');
    Route::view('/about-alex', 'about.alex')->name('about.alex');
    Route::view('/about-younes', 'about.younes')->name('about.younes');
});

