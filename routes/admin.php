<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin::')->middleware('web')->group(function () {

    Route::get('/', function () {
        return view('admin.auth.login');
    });

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::get('/dashboard/test', function () {
        return view('admin.dashboard');
    })->name('dashboard.test');
    Route::middleware('auth')->group(function () {
    });
});