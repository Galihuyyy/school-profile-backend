<?php

use App\Http\Controllers\admin\auth\LoginController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ManageAdminController;
use App\Http\Controllers\SchoolSettingController;
use App\Http\Controllers\TeacherController;
use App\Mail\VerifyAdminEmail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin::')->middleware('web')->group(function () {

    Route::prefix('/auth')->group(function () {
        Route::view('/', 'admin.auth.login')->name('login');
        Route::post('/', [LoginController::class, 'loginProcess'])->name('login.process');
    });

        
    Route::get('/verify-email/{id}', [LoginController::class, 'verify'])
        ->middleware('signed')
        ->name('verification.verify');

    Route::middleware('auth')->group(function () {
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
        
        Route::prefix('/school-settings')->name('school-settings')->group(function () {
            Route::get('/', [SchoolSettingController::class, 'index'])->name('.index');

            Route::middleware('hasPermission:school_info')->group(function () {
                Route::get('/edit', [SchoolSettingController::class, 'edit'])->name('.edit');
                Route::put('/update', [SchoolSettingController::class, 'update'])->name('.update');
                Route::post('/socmed/update', [SchoolSettingController::class, 'updateSocmed'])->name('.socmed.update');
            });
        });
    
        // crud teacher
        Route::resource('manage-teachers', TeacherController::class)->names('teachers');
        Route::middleware('hasPermission:manage_teacher')->group(function () {
            Route::resource('manage-teachers', TeacherController::class)->except('index')->names('teachers');
        });
        
        // crud admin
        Route::resource('manage-admins', ManageAdminController::class)->parameters(['manage-admins' => 'admin'])->names('admins');
        Route::middleware('hasPermission:manage_admin')->group(function () {
            Route::resource('manage-admins', ManageAdminController::class)->parameters(['manage-admins' => 'admin'])->except('index')->names('admins');
            Route::view('/manage-admins/create/success', 'admin.admin-management.create-success')->name('admins.create.success');
        });
    
        // crud departments
        Route::prefix('/departments')->name('departments.')->group(function () {
            // route departments in progress
        });
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
