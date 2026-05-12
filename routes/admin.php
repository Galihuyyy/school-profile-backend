<?php

use App\Http\Controllers\admin\auth\LoginController;
use App\Http\Controllers\admin\JobController;
use App\Http\Controllers\admin\ManageAdminController;
use App\Http\Controllers\admin\SchoolSettingController;
use App\Http\Controllers\admin\TeacherController;
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
        
        // school setting
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
            Route::resource('manage-teachers', TeacherController::class)->except(['index', 'show'])->names('teachers');
        });
        
        // crud admin
        Route::resource('manage-admins', ManageAdminController::class)->parameters(['manage-admins' => 'admin'])->names('admins');
        Route::middleware('hasPermission:manage_admin')->group(function () {
            Route::resource('manage-admins', ManageAdminController::class)->parameters(['manage-admins' => 'admin'])->except(['index', 'show'])->names('admins');
            Route::view('/manage-admins/create/success', 'admin.admin-management.create-success')->name('admins.create.success');
        });
        
        // crud departments
        Route::prefix('/departments')->name('departments.')->group(function () {
            // route departments in progress
        });
            
        Route::resource('manage-jobs', JobController::class)->parameters(['manage-jobs' => 'job'])->names('jobs');
        Route::middleware('hasPermission:manage_job')->group(function () {
            Route::resource('manage-jobs', JobController::class)->parameters(['manage-jobs' => 'job'])->except(['index', 'show'])->names('jobs');
        });

    });
});
