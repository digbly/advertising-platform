<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Web Routes
|--------------------------------------------------------------------------
|
| Các route giao diện admin (Blade + Tailwind). Layout chính nằm ở
| resources/views/layouts/admin.blade.php.
|
*/

Route::view('/admin', 'admin.dashboard')->name('admin.dashboard');
