<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ShortUrlController;
use App\Http\Controllers\Api\Auth\ProfileController;
use App\Http\Controllers\Api\Auth\PasswordController;
use App\Http\Controllers\Api\Auth\RegisteredUserController;
use App\Http\Controllers\Api\Auth\AuthenticatedSessionController;

Route::middleware('guest:sanctum')->group(function () {
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');
});

Route::middleware('auth:sanctum')->name('auth.')->group(function () {
    Route::get('/me', [ProfileController::class, 'me'])->name('me');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::apiResource('shorturls', ShortUrlController::class)->only(['index', 'store', 'destroy'])->parameters([
        'shorturls' => 'shortUrl'
    ]);
});
