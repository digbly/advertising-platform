<?php

use Illuminate\Support\Facades\Route;
use Modules\Advertising\Http\Controllers\AdvertisingController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('advertisings', AdvertisingController::class)->names('advertising');
});
