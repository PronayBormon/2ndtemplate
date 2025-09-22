<?php

use App\Models\DynamicPage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Backend\User\UserController;
use App\Http\Controllers\Web\Backend\User\ProfileController;
use App\Http\Controllers\Web\Backend\Settings\SystemSettingController;
use App\Http\Controllers\Web\Backend\DynamicPage\DynamicPageController;

Route::prefix('admin')
    ->middleware(['auth:sanctum', 'role:admin,super_admin,manager,editor'])
    ->group(function () {
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

        // user list 
        Route::controller(UserController::class)->group(function () {
            Route::get('user', 'userlist')->name('backend.user.list');
            Route::post('user', 'userStore')->name('backend.user.store');
            Route::get('user/details/{id}', 'userDetails')->name('backend.users.details');
            Route::put('user/details/update/{id}', 'userUpdate')->name('backend.user.update');
            Route::put('user/password/update/{id}', 'updatePassword')->name('backend.user.pass.update');
        });

        // DynamicPage
        Route::controller(DynamicPageController::class)->group(function () {
            Route::get('pages', 'index')->name('backend.pages.list');
            Route::get('pages/edit/{id}', 'pageEdit')->name('backend.pages.edit');
            Route::put('pages/update/{id}', 'pageUpdate')->name('backend.pages.update');
        });

        Route::get('/system/settings', [SystemSettingController::class, 'edit'])->name('admin.settings.edit');
        Route::post('/system/settings', [SystemSettingController::class, 'update'])->name('admin.settings.update');
    });

require __DIR__ . '/auth.php';
