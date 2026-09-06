<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Web Routes
|--------------------------------------------------------------------------
|
| Admin panel routes (Blade + Tailwind). Main layout:
| resources/views/layouts/admin.blade.php.
|
*/

// ── Language switcher ─────────────────────────────────────────────
Route::get('/admin/set-locale/{locale}', function (string $locale) {
    if (in_array($locale, ['en', 'vi'], true)) {
        session(['locale' => $locale]);
        app()->setLocale($locale);
    }

    return redirect()->back();
})->name('locale.set');

// ── Admin dashboard ──────────────────────────────────────────────
Route::view('/admin', 'admin.dashboard')->name('admin.dashboard');
