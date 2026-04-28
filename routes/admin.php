<?php

use App\Http\Controllers\admin\auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin::')->middleware('web')->group(function () {

    Route::prefix('/auth')->group(function () {
        Route::view('/', 'admin.auth.login')->name('login');
        Route::post('/', [LoginController::class, 'loginProcess'])->name('login.process');
    });

    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // testing
    Route::get('/dashboard/test', function () {
        return view('admin.dashboard');
    })->name('dashboard.test');
    Route::middleware('auth')->group(function () {
    });
});