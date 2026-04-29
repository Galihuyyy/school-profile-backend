<?php

use App\Http\Controllers\admin\auth\LoginController;
use App\Http\Controllers\SchoolSettingController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin::')->middleware('web')->group(function () {

    Route::prefix('/auth')->group(function () {
        Route::view('/', 'admin.auth.login')->name('login');
        Route::post('/', [LoginController::class, 'loginProcess'])->name('login.process');
    });

    Route::get('/school-settings', [SchoolSettingController::class, 'index'])->name('school-settings.index');
    Route::get('/school-settings/edit', [SchoolSettingController::class, 'edit'])->name('school-settings.edit');
    Route::put('/school-settings/update', [SchoolSettingController::class, 'update'])->name('school-settings.update');
    Route::post('/school-settings/socmed/update', [SchoolSettingController::class, 'updateSocmed'])->name('school-settings.socmed.update');

    // testing
    Route::get('/dashboard/test', function () {
        return view('admin.dashboard');
    })->name('dashboard.test');
    Route::middleware('auth')->group(function () {
    });
});