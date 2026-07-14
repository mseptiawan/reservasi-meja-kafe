<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AnnouncementController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('tables', TableController::class);
    });
});


require __DIR__.'/auth.php';
