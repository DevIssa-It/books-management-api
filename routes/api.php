<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookController;

// Auth routes (public)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me',      [AuthController::class, 'me']);

    Route::get('/books',         [BookController::class, 'index']);
    Route::post('/books',        [BookController::class, 'simpan']);
    Route::get('/books/{id}',    [BookController::class, 'show']);
    Route::put('/books/{id}',    [BookController::class, 'update']);
    Route::delete('/books/{id}', [BookController::class, 'destroy']);
});
