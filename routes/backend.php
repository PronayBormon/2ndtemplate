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
        Route::post('user', 'userStore')->name('backend.user.store');
        Route::get('user/details/{id}', 'userDetails')->name('backend.users.details');
        Route::put('user/details/update/{id}', 'userUpdate')->name('backend.user.update');
        Route::put('user/password/update/{id}', 'updatePassword')->name('backend.user.pass.update');
    });
});

require __DIR__ . '/auth.php';
