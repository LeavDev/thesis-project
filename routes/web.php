<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.admin.index');
});

Route::get('/login', function () {
    return view('pages.login');
});
