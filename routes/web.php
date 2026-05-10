<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::fallback(function () {
    return redirect()->route('user::index');
});

Route::name('user::')->group(function() {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/test', function() {
        return view('guest.detail-berita');
    });
    Route::get('/test-create', function() {
        return view('guest.pages.guru.list-guru');
    });
});
