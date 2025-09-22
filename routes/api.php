<?php

use App\Http\Controllers\API\Auth\AuthAPIController;
use App\Http\Controllers\API\Auth\ForgetPassAPIController;
use App\Http\Controllers\API\Auth\ProfileApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// <!---------------------- Auth -------------------------> 
Route::prefix('auth')->controller(AuthAPIController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::post('email-verify', 'verifyEmail');
    Route::post('resend-otp', 'resendOtp');
});

Route::prefix('password')->controller(ForgetPassAPIController::class)->group(function () {
    Route::post('forget', 'ForgetPassword');
    Route::post('verify-email', 'verifyOtp');
    Route::post('new', 'reset_password');
});

/**
 * ==================================== Auth routes ================================
 */

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('user')->controller(ProfileApiController::class)->group(function () {
        Route::get('profile', 'index');
        Route::put('update', 'updateDetails');
    });
});
