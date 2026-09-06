<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\API\ApiKeyController;
use Modules\Auth\Http\Controllers\API\AuthController;
use Modules\Auth\Http\Controllers\API\CaptchaController;
use Modules\Auth\Http\Controllers\API\ProfileController;
use Modules\Auth\Http\Controllers\API\SocialLoginController;

/*
|--------------------------------------------------------------------------
| Social Providers (public)
|--------------------------------------------------------------------------
*/
Route::prefix('auth')->group(function () {
    Route::get('social-providers', [SocialLoginController::class, 'providers'])->name('api.auth.social-providers');
});

/*
|--------------------------------------------------------------------------
| PoW Challenge (public, throttle)
|--------------------------------------------------------------------------
*/
Route::middleware('throttle:auth')->post('request-challenge', [CaptchaController::class, 'requestChallenge']);

/*
|--------------------------------------------------------------------------
| Auth Routes (throttle)
|--------------------------------------------------------------------------
*/
Route::prefix('auth/user')->group(function () {
    Route::middleware('throttle:auth')->group(function () {
        Route::post('login', [AuthController::class, 'login'])->middleware('captcha');
        Route::post('refresh-token', [AuthController::class, 'refreshToken']);
        Route::post('register', [AuthController::class, 'register'])->middleware('captcha');
        Route::post('resend-verification-email', [AuthController::class, 'resendVerificationEmail']);
        Route::post('email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->name('verification.verify');
        Route::post('forgot-password', [AuthController::class, 'forgotPassword'])->middleware('captcha');
        Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('password.reset');

        Route::get('social/{driver}/redirect', [SocialLoginController::class, 'redirect'])->name('api.user.social.redirect');
        Route::post('social/{driver}/callback', [SocialLoginController::class, 'callback'])->name('api.user.social.callback');
    });

    Route::middleware('auth:api')->group(function () {
        Route::put('change-password', [AuthController::class, 'changePassword']);
        Route::post('logout', [AuthController::class, 'logout']);
    });
});

/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:api'])->prefix('profile')->group(function () {
    Route::get('/', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/', [ProfileController::class, 'update'])->name('profile.update');
});

/*
|--------------------------------------------------------------------------
| API Key Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:api'])->prefix('api-keys')->group(function () {
    Route::get('/', [ApiKeyController::class, 'index'])->name('api-keys.index');
    Route::post('/', [ApiKeyController::class, 'store'])->name('api-keys.store');
    Route::get('{id}', [ApiKeyController::class, 'show'])->name('api-keys.show');
    Route::put('{id}', [ApiKeyController::class, 'update'])->name('api-keys.update');
    Route::delete('{id}', [ApiKeyController::class, 'destroy'])->name('api-keys.destroy');
});
