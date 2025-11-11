<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('components.pages.admin');
});

Route::get('dashboard', function () {
    return view('components.pages.dashboard');
});
