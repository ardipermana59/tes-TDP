<?php

use App\Http\Controllers\Admin\AdminCheckinController;
use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\Admin\AdminTicketController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth:sanctum'])->get('/', DashboardController::class)->name('dashboard'); 

// Peserta Routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/daftar', [EventController::class, 'daftar'])->name('daftar'); 
});

// Admin Routes
Route::middleware(['auth:sanctum'])->prefix('admin')->group(function () {
    Route::get('/pesanan', [AdminTicketController::class, 'index'])->name('admin.pesanan'); 
    Route::delete('/pesanan/{id}', [AdminTicketController::class, 'destroy'])->name('admin.tickets.destroy');
    Route::put('/pesanan/{id}', [AdminTicketController::class, 'update'])->name('admin.tickets.update');
    Route::get('/checkin', [AdminCheckinController::class, 'index'])->name('admin.checkin');
    Route::post('/check/ticket', [AdminCheckinController::class, 'checkTicket'])->name('admin.check.ticket');
    Route::get('/laporan', [AdminReportController::class, 'index'])->name('admin.report');
});
