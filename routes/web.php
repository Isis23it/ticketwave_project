<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MisBoletosController;
use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\LandingController::class, 'index'])->name('landing');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/mis-boletos', [MisBoletosController::class, 'index'])->name('mis-boletos');
});

Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin-panel')->group(function () {
    Route::get('/', function () {
        return 'Panel de administración';
    })->name('admin.index');
});

Route::middleware(['auth', 'verified', 'role:organizador'])->prefix('organizador')->group(function () {
    Route::get('/', function () {
        return 'Panel de organizador';
    })->name('organizador.index');
});

require __DIR__.'/auth.php';