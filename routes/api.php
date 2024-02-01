<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FileController;
use App\Http\Controllers\Api\TokenController;
use App\Http\Controllers\Api\PostController;
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
| API POSTS
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->get('posts', [PostController::class, 'index']);
Route::middleware('auth:sanctum')->get('posts/{post}', [PostController::class, 'show']);
Route::middleware('auth:sanctum')->post('posts', [PostController::class, 'store']);
Route::middleware('auth:sanctum')->put('posts/{post}', [PostController::class, 'update']);
Route::middleware('auth:sanctum')->delete('posts/{post}', [PostController::class, 'destroy']);
Route::middleware('auth:sanctum')->post('posts/{post}/likes', [PostController::class, 'like']);
Route::middleware('auth:sanctum')->delete('posts/{post}/likes', [PostController::class, 'unlike']);


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('files/{file}', [FileController::class, 'update_workaround']);
Route::apiResource('files', FileController::class);
