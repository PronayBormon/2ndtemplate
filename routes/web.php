<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    $total = User::count();
    $user = User::where('role', 'user')->count();

    $active = User::where('status', 'active')->count();
    $inactive = User::where('status', 'inactive')->count();
    $banned = User::where('status', 'banned')->count();
    return view('backend.layouts.dashboard', compact(
        "total",
        "user",
        "active",
        "inactive",
        "banned"
    ));
})->middleware(['auth:sanctum', 'role:admin,super_admin,manager,editor'])->name('home');

Route::get('/dashboard', function () {

    $total = User::count();
    $user = User::where('role', 'user')->count();

    $active = User::where('status', 'active')->count();
    $inactive = User::where('status', 'inactive')->count();
    $banned = User::where('status', 'banned')->count();
    return view('backend.layouts.dashboard', compact(
        "total",
        "user",
        "active",
        "inactive",
        "banned"
    ));
})->middleware(['auth:sanctum', 'role:admin,super_admin,manager,editor'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';
require __DIR__ . '/backend.php';
