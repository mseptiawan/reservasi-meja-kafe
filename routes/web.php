<?php

use App\Http\Controllers\AccountStatusController;
use App\Http\Controllers\Admin\AccountApprovalController;
use App\Http\Controllers\Admin\AdminReservationController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnnouncementController;
use App\Models\Announcement;
use App\Models\Table;

use Illuminate\Support\Facades\Route;

// --- PUBLIC ROUTES ---
Route::get('/', function () {
    $announcements = Announcement::where('status', 'published')->latest()->take(3)->get();
    $tables = Table::where('is_active', true)->orderBy('table_number', 'asc')->get();
    return view('welcome', compact('announcements', 'tables'));
})->name('welcome');

Route::get('/cek-status', [AccountStatusController::class, 'index'])->name('account.status');
Route::post('/cek-status', [AccountStatusController::class, 'check'])->name('account.status.check');

// --- AUTHENTICATED ROUTES ---
Route::middleware('auth')->group(function () {
    // Dashboard & Profile
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('verified')
        ->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Pelanggan: Alur Reservasi
    Route::prefix('reservasi')
        ->name('reservasi.')
        ->group(function () {
            Route::get('/', [ReservationController::class, 'index'])->name('index');
            Route::get('/riwayat', [ReservationController::class, 'history'])->name('history');
            Route::get('/create/{table_id}', [ReservationController::class, 'create'])->name('create');
            Route::post('/store', [ReservationController::class, 'store'])->name('store');
            Route::get('/{id}', [ReservationController::class, 'show'])->name('show');
        });

    Route::prefix('announcements')
        ->name('announcements.')
        ->group(function () {
            Route::get('/', [AnnouncementController::class, 'index'])->name('index');
        });

    // Pelanggan: Alur Pembayaran
    Route::prefix('pembayaran')
        ->name('payment.')
        ->group(function () {
            Route::get('/', [PaymentController::class, 'index'])->name('confirm');
            Route::get('/proses/{reservation_id}', [PaymentController::class, 'create'])->name('create');
            Route::post('/store/{reservation_id}', [PaymentController::class, 'store'])->name('store');
        });

    // --- AREA BACKOFFICE / ADMIN ---
    Route::prefix('admin')
        ->name('admin.')
        ->group(function () {
            // Master Data (Resources)
            Route::resource('tables', TableController::class);
            Route::resource('announcements', AnnouncementController::class);

            // Manajemen Pelanggan & Approval Akun Baru
            Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
            Route::get('/approvals', [AccountApprovalController::class, 'index'])->name('approvals.index');
            Route::patch('/approvals/{user}/verify', [AccountApprovalController::class, 'verify'])->name('approvals.verify');

            // Manajemen Reservasi Fisik
            Route::get('/reservations', [AdminReservationController::class, 'index'])->name('reservations.index');
            Route::patch('/reservations/{id}/update-status', [AdminReservationController::class, 'updateStatus'])->name('reservations.update_status');

            // Manajemen Verifikasi Keuangan
            Route::get('/payments', [PaymentController::class, 'adminIndex'])->name('payments.index');
            Route::patch('/payments/{id}/verify', [PaymentController::class, 'adminVerify'])->name('payments.verify');
        });
});

require __DIR__ . '/auth.php';
