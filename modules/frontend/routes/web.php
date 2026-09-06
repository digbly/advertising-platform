<?php

use Illuminate\Support\Facades\Route;
use Modules\Frontend\Http\Controllers\FrontendController;

// ── Public homepage ──────────────────────────────────────────────
Route::get('/', [FrontendController::class, 'home'])->name('frontend.home');
