<?php

use App\Http\Controllers\admin\auth\LoginController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\SchoolSettingController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin::')->middleware('web')->group(function () {

    Route::prefix('/auth')->group(function () {
        Route::view('/', 'admin.auth.login')->name('login');
        Route::post('/', [LoginController::class, 'loginProcess'])->name('login.process');
    });

    // school setting
    Route::get('/school-settings', [SchoolSettingController::class, 'index'])->name('school-settings.index');
    Route::get('/school-settings/edit', [SchoolSettingController::class, 'edit'])->name('school-settings.edit');
    Route::put('/school-settings/update', [SchoolSettingController::class, 'update'])->name('school-settings.update');
    Route::post('/school-settings/socmed/update', [SchoolSettingController::class, 'updateSocmed'])->name('school-settings.socmed.update');

    // crud teacher
    Route::prefix('/teachers')->name('teachers.')->group(function () {
        Route::get('/', [TeacherController::class, 'index'])->name('index');
        Route::get('/create', [TeacherController::class, 'create'])->name('create');
        Route::get('/{teacher}', [TeacherController::class, 'show'])->name('show');
        Route::get('/{teacher}/edit', [TeacherController::class, 'edit'])->name('edit');
        Route::post('/', [TeacherController::class, 'store'])->name('store');
        Route::put('/{teacher}', [TeacherController::class, 'update'])->name('update');
        Route::delete('/{teacher}', [TeacherController::class, 'destroy'])->name('destroy');
    });

    // crud departments
    Route::prefix('/departments')->name('departments.')->group(function () {
        Route::get('/', [DepartmentController::class, 'index'])->name('index');
        Route::get('/create', [DepartmentController::class, 'create'])->name('create');
        Route::get('/{department}', [DepartmentController::class, 'show'])->name('show');
        Route::get('/{department}/edit', [DepartmentController::class, 'edit'])->name('edit');
        Route::post('/', [DepartmentController::class, 'store'])->name('store');
        Route::put('/{department}', [DepartmentController::class, 'update'])->name('update');
        Route::delete('/{department}', [DepartmentController::class, 'destroy'])->name('destroy');
    });
});
