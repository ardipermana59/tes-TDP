<?php

use App\Http\Controllers\Admin\AdminCheckinController;
use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\Admin\AdminTicketController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// Route::get('/daftar', [RegisterController::class, 'showRegistrationForm'])->name('register');
// Route::post('/daftar', [RegisterController::class, 'register']);

Route::middleware(['auth:sanctum'])->get('/', DashboardController::class)->name('dashboard'); 
// Peserta Routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/daftar', [EventController::class, 'daftar'])->name('daftar'); 
});

// Admin Routes
Route::middleware(['auth:sanctum'])->prefix('admin')->group(function () {
    Route::get('/pesanan', [AdminTicketController::class, 'index'])->name('admin.pesanan'); 
    Route::get('/checkin', [AdminCheckinController::class, 'index'])->name('admin.checkin');
    Route::post('/check/ticket', [AdminCheckinController::class, 'checkTicket'])->name('admin.check.ticket');
    Route::get('/laporan', [AdminReportController::class, 'index'])->name('admin.report');
});
