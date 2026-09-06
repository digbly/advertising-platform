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
        Route::post('login', [AuthController::class, 'login'])->middleware('captcha')->name('auth.user.login');
        Route::post('refresh-token', [AuthController::class, 'refreshToken'])->name('auth.user.refresh-token');
        Route::post('register', [AuthController::class, 'register'])->middleware('captcha')->name('auth.user.register');
        Route::post('resend-verification-email', [AuthController::class, 'resendVerificationEmail'])->name('auth.user.resend-verification-email');
        Route::post('email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->name('auth.user.verify');
        Route::post('forgot-password', [AuthController::class, 'forgotPassword'])->middleware('captcha')->name('auth.user.forgot-password');
        Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('auth.user.reset-password');

        Route::get('social/{driver}/redirect', [SocialLoginController::class, 'redirect'])->name('auth.user.social.redirect');
        Route::post('social/{driver}/callback', [SocialLoginController::class, 'callback'])->name('auth.user.social.callback');
    });

    Route::middleware('auth:api')->group(function () {
        Route::put('change-password', [AuthController::class, 'changePassword'])->name('auth.user.change-password');
        Route::post('logout', [AuthController::class, 'logout'])->name('auth.user.logout');
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
