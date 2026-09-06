<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Auth Web Routes
|--------------------------------------------------------------------------
|
| Auth pages (Blade + Tailwind). Layout:
| modules/auth/resources/views/components/layouts/master.blade.php.
|
| Forms POST to the API endpoints (api.auth.user.*) defined in routes/api.php.
|
*/

Route::get('/login', fn () => view('auth::login'))->name('auth.login');
Route::get('/register', fn () => view('auth::register'))->name('auth.register');
Route::get('/forgot-password', fn () => view('auth::forgot-password'))->name('auth.forgot-password');
Route::get('/reset-password/{token}', fn (string $token) => view('auth::reset-password', ['token' => $token]))->name('auth.reset-password');
Route::get('/verify-email', fn () => view('auth::verify-email'))->name('auth.verify-email');
