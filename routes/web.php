<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('components.pages.admin');
});

Route::get('dashboard', function () {
    return view('components.pages.dashboard');
});

Route::get('account-management', function () {
    return view('components.pages.account-management');
});

Route::get('vendor-management', function () {
    return view('components.pages.vendor-management');
});

Route::get('settings', function () {
    return view('components.pages.settings');
});
