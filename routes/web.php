<!--
Aturan Pemberian Route Name
(page).(method)

contoh:
    ->name('post.create')

Cara penggunaan nantinya akan seperti
route('admin::post.create')
-->
<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin::')->group(function() {

});

Route::name('user::')->group(function() {
    Route::get('/', function() {
        return view('welcome');
    });
});
