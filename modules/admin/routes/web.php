<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\SettingController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('settings', [SettingController::class, 'index'])->name('admin.settings.index');
    Route::put('settings', [SettingController::class, 'update'])->name('admin.settings.update');
});
