<?php

use Illuminate\Support\Facades\Route;
use Modules\Advertising\Http\Controllers\AdvertisingController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('advertisings', AdvertisingController::class)->names('advertising');
});
