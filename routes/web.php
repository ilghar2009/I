<?php

use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Support\Facades\Route;

Route::group([AuthenticateSession::class], function(){
});

Route::middleware('auth')->group(function(){
    Route::post('/authenticate',[\App\Http\Controllers\AuthController::class,'authenticate'])->name('auth');
});

Route::get('/Auth',[\App\Http\Controllers\AuthController::class,'index'])->name('authP');

Route::middleware('AuthCheck')->group(function(){
    Route::get('/', [\App\Http\Controllers\PostController::class, 'index'])->name('home');
});