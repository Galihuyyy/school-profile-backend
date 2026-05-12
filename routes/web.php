<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::fallback(function () {
    return redirect()->route('user::index');
});

Route::name('user::')->group(function() {
    Route::get('/', [UserController::class, 'index'])->name('index');
    
    Route::prefix('lowongan')->name('jobs.')->group(function() {
        Route::get('/', [UserController::class, 'jobIndex'])->name('index');
        Route::get('/{lowongan}', [UserController::class, 'jobShow'])->name('show');
        
    });
    
    Route::get('/test', function() {
        return view('guest.detail-berita');
    });
    Route::get('/test-create', function() {
        return view('guest.pages.guru.list-guru');
    });
});
