<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRoleMiddleware;
use App\Http\Controllers\Backend\LokerController;
use App\Http\Controllers\Backend\LamaranController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ListLokerController;
use App\Http\Controllers\Backend\JadwalInterviewController;
use App\Http\Controllers\Backend\PelamarInterviewController;

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

    // Hanya pengguna dengan role pelamar yang dapat mengakses route ini
    Route::middleware(CheckRoleMiddleware::class . ':pelamar')->group(function () {
        Route::resource('/list', ListLokerController::class)->only('index', 'show')->names('panel.list');
        Route::match(['get', 'post'], '/list/{uuid}/apply', function ($uuid) {
            if (request()->isMethod('get')) {
                if (!Auth::check()) {
                    return redirect()->route('login');
                }
                return response()->view('errors.403', [], 403);
            }

            return app(ListLokerController::class)->apply(request(), $uuid);
        })->name('panel.list.apply');

        Route::get('/interview', [PelamarInterviewController::class, 'index'])->name('panel.jadwal-interview.pelamar.index');
        Route::get('/interview/{uuid}', [PelamarInterviewController::class, 'show'])->name('panel.jadwal-interview.pelamar.show');
    });

    // Hanya pengguna dengan role admin yang dapat mengakses route ini
    Route::middleware(CheckRoleMiddleware::class . ':admin')->group(function () {
        Route::resource('/loker', LokerController::class)->names('panel.loker');
        Route::resource('/lamaran', LamaranController::class)->except('create', 'store')->names('panel.lamaran');
        Route::post('/lamaran/download', [LamaranController::class, 'download'])->name('panel.lamaran.download');
        Route::resource('/kelola-interview', JadwalInterviewController::class)->names('panel.jadwal-interview');
    });
});
