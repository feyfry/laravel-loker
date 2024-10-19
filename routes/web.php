<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

// Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('panel')->middleware('auth')->group(function () {
    // Pengguna dengan role admin dan pelamar, keduanya dapat mengakses route ini
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('panel.dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('panel.profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('panel.profile.update');

    // Hanya pengguna dengan role admin yang dapat mengakses route ini
});
