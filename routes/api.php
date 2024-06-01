<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Comment\CommentController;
use App\Http\Controllers\Post\PostController;

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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/add-post', [PostController::class, 'addPost']);
    Route::get('/get-all-post', [PostController::class, 'getAllPost']);
    Route::get('/get-post/{id}', [PostController::class, 'getPost']);
    Route::put('/update-post/{id}', [PostController::class, 'UpdatePost']);
    Route::delete('/delete-post/{id}', [PostController::class, 'DeletePost']);
    Route::post('/add-comment', [CommentController::class, 'addComment']);
    Route::post('/add-like', [PostController::class, 'addLike']);

});


