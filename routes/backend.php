<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Backend\User\UserController;
use App\Http\Controllers\Web\Backend\User\ProfileController;

Route::prefix('admin')->middleware('auth:sanctum')->group(function () {
    // user profile 
    Route::controller(ProfileController::class)->group(function () {
        Route::get('profile', 'index')->name('backend.admin.profile');
        Route::put('profile', 'updateProfile')->name('backend.admin.profile.update');
    });



    // user list 
    Route::controller(UserController::class)->group(function () {
        Route::get('user', 'userlist')->name('backend.user.list');
        Route::get('user/details/{id}', 'userDetails')->name('backend.users.details');
    });
});

require __DIR__ . '/auth.php';
