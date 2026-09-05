<?php

use Illuminate\Support\Facades\Route;
use Modules\Contact\Http\Controllers\Admin\AdminContactController;
use Modules\Contact\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Public Contact (no auth, PoW captcha + throttle)
|--------------------------------------------------------------------------
*/
Route::middleware(['throttle:10,1', 'captcha'])->prefix('v1')->group(function () {
    Route::post('contacts', [ContactController::class, 'store'])->name('contacts.store');
});

/*
|--------------------------------------------------------------------------
| Admin Contact Management
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:api', 'admin'])->prefix('v1/admin')->group(function () {
    Route::get('contacts', [AdminContactController::class, 'index'])->name('admin.contacts.index');
    Route::get('contacts/{contact}', [AdminContactController::class, 'show'])->name('admin.contacts.show');
    Route::put('contacts/{contact}/status', [AdminContactController::class, 'updateStatus'])->name('admin.contacts.update-status');
    Route::delete('contacts/{contact}', [AdminContactController::class, 'destroy'])->name('admin.contacts.destroy');
});
