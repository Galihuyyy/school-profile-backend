<?php

use App\Http\Controllers\admin\auth\LoginController;
use App\Http\Controllers\admin\DepartmentController;
use App\Http\Controllers\admin\JobController;
use App\Http\Controllers\admin\ManageAdminController;
use App\Http\Controllers\admin\PostsController;
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
        Route::resource('manage-teachers', TeacherController::class)->parameters(['manage-teachers' => 'teacher'])->names('teachers');
        Route::middleware('hasPermission:manage_teacher')->group(function () {
            Route::resource('manage-teachers', TeacherController::class)->parameters(['manage-teachers' => 'teacher'])->except('index')->names('teachers');
        });

        // crud department
        Route::resource('manage-departments', DepartmentController::class)->parameters(['manage-departments' => 'department'])->names('departments');
        Route::middleware('hasPermission:manage_department')->group(function () {
            Route::resource('manage-departments', DepartmentController::class)->parameters(['manage-departments' => 'department'])->except('index')->names('departments');
        });

        // crud admin
        Route::resource('manage-admins', ManageAdminController::class)->parameters(['manage-admins' => 'admin'])->names('admins');
        Route::middleware('hasPermission:manage_admin')->group(function () {
            Route::resource('manage-admins', ManageAdminController::class)->parameters(['manage-admins' => 'admin'])->except(['index', 'show'])->names('admins');
            Route::view('/manage-admins/create/success', 'admin.admin-management.create-success')->name('admins.create.success');
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
            
        Route::resource('manage-jobs', JobController::class)->parameters(['manage-jobs' => 'job'])->names('jobs');
        Route::middleware('hasPermission:manage_job')->group(function () {
            Route::resource('manage-jobs', JobController::class)->parameters(['manage-jobs' => 'job'])->except(['index', 'show'])->names('jobs');
        });

        Route::resource('posts', PostsController::class)->names('posts');
        Route::middleware('hasPermission:manage_post')->group(function () {
            Route::resource('posts', PostsController::class)->except(['index', 'show'])->names('posts');
        });

    });
});
