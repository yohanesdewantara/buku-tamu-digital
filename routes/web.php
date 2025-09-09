<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\GuestController as AdminGuestController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\GuestController as UserGuestController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/login');
});

// Authentication Routes
require __DIR__.'/auth.php';

// Redirect after login based on role
Route::get('/dashboard', function () {
    if (auth()->user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Guests Management
    Route::resource('guests', AdminGuestController::class);

    // User Management
    Route::resource('users', AdminUserController::class)->except(['show']);

    // Reports
    Route::get('/reports', [AdminReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/export-excel', [AdminReportController::class, 'exportExcel'])->name('reports.export-excel');
    Route::get('/reports/export-pdf', [AdminReportController::class, 'exportPdf'])->name('reports.export-pdf');
});

// User/Receptionist Routes
Route::middleware(['auth', 'receptionist'])->prefix('user')->name('user.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    // Guests (limited access)
    Route::get('/guests', [UserGuestController::class, 'index'])->name('guests.index');
    Route::get('/guests/create', [UserGuestController::class, 'create'])->name('guests.create');
    Route::post('/guests', [UserGuestController::class, 'store'])->name('guests.store');
    Route::get('/guests/{guest}', [UserGuestController::class, 'show'])->name('guests.show');
});
