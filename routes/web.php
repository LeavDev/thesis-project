<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::middleware(['firebase.auth'])->group(function () {
    Route::get('/', function () {
        return view('pages.admin.index');
    })->name('admin.dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::middleware(['guest'])->group(function () {
    Route::controller(RegisterController::class)->group(function () {
        Route::get('/register', 'index')->name('register');
        Route::post('/register', 'register')->name('register.auth');
    });

    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'index')->name('login');
        Route::post('/login', 'login')->name('login.auth');
    });
});
