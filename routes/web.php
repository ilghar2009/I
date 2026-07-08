<?php

use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group([AuthenticateSession::class], function (){
    Route::post('/authenticate',[\App\Http\Controllers\AuthController::class,'authenticate'])->name('auth');
});

Route::get('/Auth',[\App\Http\Controllers\AuthController::class,'index'])->name('authP');