<?php

use Illuminate\Support\Facades\Route;

Route::name('user::')->group(function() {
    Route::get('/', function() {
        return view('guest.index');
    });
    Route::get('/test', function() {
        return view('guest.detail-berita');
    });
    Route::get('/test-create', function() {
        return view('guest.pages.guru.list-guru');
    });
});
