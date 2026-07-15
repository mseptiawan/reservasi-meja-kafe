<?php

use App\Http\Controllers\AccountStatusController;
use App\Http\Controllers\Admin\AccountApprovalController;
use App\Http\Controllers\Admin\AdminReservationController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AnnouncementController;
use App\Models\Announcement;
use App\Models\Table;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $announcements = Announcement::where('status', 'published')->latest()->take(3)->get();

    $tables = Table::where('is_active', true)->orderBy('table_number', 'asc')->get();

    return view('welcome', compact('announcements', 'tables'));
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::resource('tables', TableController::class);
            Route::resource('announcements', AnnouncementController::class);
            Route::get('/approvals', [AccountApprovalController::class, 'index'])->name('approvals.index');
            Route::patch('/approvals/{user}/verify', [AccountApprovalController::class, 'verify'])->name('approvals.verify');
            Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');

            Route::get('/reservations', [AdminReservationController::class, 'index'])->name('reservations.index');
            Route::patch('/reservations/{id}/update-status', [AdminReservationController::class, 'updateStatus'])->name('reservations.update_status');

            Route::get('/payments', [PaymentController::class, 'adminIndex'])->name('payments.index');
            Route::patch('/payments/{id}/verify', [PaymentController::class, 'adminVerify'])->name('payments.verify');
        });

    Route::get('/reservasi', [ReservationController::class, 'index'])->name('reservasi.index');
    Route::get('/reservasi/create/{table_id}', [ReservationController::class, 'create'])->name('reservasi.create');
    Route::post('/reservasi/store', [ReservationController::class, 'store'])->name('reservasi.store');
    Route::get('/reservasi/detail/{id}', [ReservationController::class, 'show'])->name('reservasi.show');
    Route::get('/reservasi/riwayat', [ReservationController::class, 'history'])->name('reservasi.history');
    Route::get('/reservasi/{id}', [ReservationController::class, 'show'])->name('reservasi.show');

    Route::get('/pembayaran', [PaymentController::class, 'index'])->name('payment.confirm');
    Route::get('/pembayaran/proses/{reservation_id}', [PaymentController::class, 'create'])->name('payment.create');
    Route::post('/pembayaran/store/{reservation_id}', [PaymentController::class, 'store'])->name('payment.store');
});

Route::get('/cek-status', [AccountStatusController::class, 'index'])->name('account.status');
Route::post('/cek-status', [AccountStatusController::class, 'check'])->name('account.status.check');

require __DIR__ . '/auth.php';
