<?php

use App\Http\Controllers\Admin\CheckinController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// Route::get('/daftar', [RegisterController::class, 'showRegistrationForm'])->name('register');
// Route::post('/daftar', [RegisterController::class, 'register']);

Route::middleware(['auth:sanctum'])->get('/', DashboardController::class)->name('dashboard'); 

Route::middleware(['auth:sanctum'])->prefix('admin')->group(function () {
    Route::get('/pesanan', [TicketController::class, 'index'])->name('admin.pesanan'); 
    Route::get('/checkin', [CheckinController::class, 'index'])->name('admin.checkin');
    Route::get('/laporan', [ReportController::class, 'index'])->name('admin.report');
});
