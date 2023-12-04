<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use Illuminate\Http\Request;
// ...
Route::get('/', function (Request $request) {
   $message = 'Loading welcome page';
   Log::info($message);
   $request->session()->flash('info', $message);
   return view('welcome');
});


Route::get('/dashboard', function (Request $request) {
return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

use App\Http\Controllers\MailController;
// ...
Route::get('mail/test', [MailController::class, 'test']);
// or
// Route::get('mail/test', 'App\Http\Controllers\MailController@test');

use App\Http\Controllers\FileController;
Route::resource('files', FileController::class)->middleware(['auth']);

use App\Http\Controllers\PlacesController;
Route::resource('places', PlacesController::class);

Route::get('places.search', 'App\Http\Controllers\PlacesController@search')->name('places.search');

// Favorites de places
Route::post('places/{place}/favs', [PlacesController::class, 'favorite'])->name('places.favorite')->middleware('can:like,place');
Route::delete('places/{place}/favs', [PlacesController::class, 'unfavorite'])->name('places.unfavorite')->middleware('can:like,place');

use App\Http\Controllers\PostController;
Route::resource('posts', PostController::class)->middleware(['auth']);

Route::get('posts.search', 'App\Http\Controllers\PostController@search')->name('posts.search');


// Likes de posts
Route::post('/posts/{post}/likes', [PostController::class, 'like'])->name('posts.likes');
Route::delete('/posts/{post}/likes', [PostController::class, 'unlike'])->name('posts.unlike');

// Multi Idioma
use App\Http\Controllers\LanguageController;
Route::get('/language/{locale}', [LanguageController::class, 'language'])->name('language');

// About

Route::get('/about', function (Request $request) {
    return view('about.index');
    })->middleware(['auth'])->name('about.index');

Route::get('/about-alex', function (Request $request) {
    return view('about.alex');
    })->middleware(['auth'])->name('about.alex');

    Route::get('/about-younes', function (Request $request) {
    return view('about.younes');
    })->middleware(['auth'])->name('about.younes');
    
    
        require __DIR__.'/auth.php';
