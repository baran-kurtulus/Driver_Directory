<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DriverController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('drivers.index'));

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::resource('drivers', DriverController::class)
    ->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])
    ->middlewareFor(['edit', 'update', 'destroy'], ['auth', 'admin']);
