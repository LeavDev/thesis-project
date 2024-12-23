<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::middleware(['firebase.auth'])->group(function () {
    Route::controller(BarangController::class)->group(function () {
        Route::get('/', 'index')->name('barang.index');
        Route::post('/store', 'store')->name('barang.store');
        Route::put('/update/{id}', 'update')->name('barang.update');
        Route::delete('/delete/{id}', 'destroy')->name('barang.destroy');
    });
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

    Route::controller(ForgotPasswordController::class)->group(function () {
        Route::get('/forgot-password', 'showForgetPasswordForm')->name('forgot-password');
        Route::post('/forgot-password', 'submitForgetPasswordForm')->name('forgot-password.auth');
    });
});
