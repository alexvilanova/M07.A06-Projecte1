<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FileController;
use App\Http\Controllers\Api\TokenController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CommentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('guest')->post('/register', [TokenController::class, 'register']);
Route::middleware('guest')->post('/login', [TokenController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', [TokenController::class, 'user']);
Route::middleware('auth:sanctum')->post('/logout', [TokenController::class, 'logout']);

/*
|--------------------------------------------------------------------------
| API POSTS & COMMENTS
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {
    // Rutas grupales relacionadas con posts
    Route::prefix('posts')->group(function () {
        Route::get('/', [PostController::class, 'index']);
        Route::get('/{post}', [PostController::class, 'show']);
        Route::post('/', [PostController::class, 'store']);
        Route::put('/{post}', [PostController::class, 'update']);
        Route::delete('/{post}', [PostController::class, 'destroy']);

        // Rutas likes sobre posts
        Route::post('/{post}/likes', [PostController::class, 'like']);
        Route::delete('/{post}/likes', [PostController::class, 'unlike']);

        // Rutas de comentarios relacionados con una publicación.
        Route::get('/{post}/comments', [CommentController::class, 'index']);
        Route::post('/{post}/comments', [CommentController::class, 'store']);
        Route::delete('/{post}/comments/{comment}', [CommentController::class, 'destroy']);
    });
});


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('files/{file}', [FileController::class, 'update_workaround']);
Route::apiResource('files', FileController::class);
