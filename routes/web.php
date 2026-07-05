<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ============================================
// PUBLIC ROUTES
// ============================================

Route::get('/', function () {
    return view('welcome');
})->name('home');

// ============================================
// AUTH ROUTES
// ============================================

Route::get('/login', [ReservationController::class, 'showLoginForm'])->name('login');
Route::post('/login', [ReservationController::class, 'login'])->name('login.post');
Route::post('/logout', [ReservationController::class, 'logout'])->name('logout');

// ============================================
// CUSTOMER BOOKING ROUTES
// ============================================

// Halaman utama booking
Route::get('/booking', [ReservationController::class, 'customerIndex'])->name('customer.booking');

// Form reservasi
Route::get('/booking/create', [ReservationController::class, 'customerCreate'])->name('customer.booking.create');
Route::post('/booking', [ReservationController::class, 'customerStore'])->name('customer.booking.store');
Route::get('/booking/success/{id}', [ReservationController::class, 'customerSuccess'])->name('customer.booking.success');
Route::post('/booking/success/{id}/upload', [ReservationController::class, 'uploadBukti'])->name('customer.booking.upload');

// Sync menu dari localStorage ke session
Route::post('/menu/sync', [ReservationController::class, 'customerSyncMenu'])->name('customer.menu.sync');

// Menu routes
Route::get('/menu', [ReservationController::class, 'customerMenuPage'])->name('customer.menu');
Route::post('/menu/simpan', [ReservationController::class, 'customerSaveMenu'])->name('customer.menu.save');

// ============================================
// MENU SELECTION ROUTES (untuk admin)
// ============================================

Route::get('/menu-pilihan', [ReservationController::class, 'reservationMenuIndex'])->name('menu.pilihan');
Route::post('/menu-pilihan/simpan', [ReservationController::class, 'storeMenu'])->name('menu.pilihan.simpan');

// ============================================
// CHECK AVAILABILITY (AJAX)
// ============================================

Route::post('/check-availability', [ReservationController::class, 'checkAvailability'])->name('checkAvailability');

// ============================================
// ADMIN ROUTES
// ============================================

Route::prefix('admin')->name('admin.')->group(function () {

    // DASHBOARD
    Route::get('/', [ReservationController::class, 'adminDashboard'])->name('dashboard');
    Route::get('/dashboard', function () {
        return redirect()->route('admin.dashboard');
    });

    // RESERVATION MANAGEMENT
    Route::prefix('reservation')->name('reservation.')->group(function () {
        Route::get('/', [ReservationController::class, 'table'])->name('table');
        Route::get('/create', [ReservationController::class, 'create'])->name('create');
        Route::post('/', [ReservationController::class, 'store'])->name('store');
        Route::get('/{id}', [ReservationController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [ReservationController::class, 'edit'])->name('edit');
        Route::put('/{id}', [ReservationController::class, 'update'])->name('update');
        Route::delete('/{id}', [ReservationController::class, 'destroy'])->name('destroy');
        Route::put('/{id}/update-status', [ReservationController::class, 'updateStatus'])->name('update-status');
        Route::get('/report', [ReservationController::class, 'report'])->name('report');
        Route::get('/{id}/pdf', [ReservationController::class, 'downloadPdf'])->name('pdf');
    });

    // MENU MANAGEMENT
    Route::prefix('menu')->name('menu.')->group(function () {
        Route::get('/', [ReservationController::class, 'menuIndex'])->name('index');
        Route::get('/create', [ReservationController::class, 'menuCreate'])->name('create');
        Route::post('/', [ReservationController::class, 'menuStore'])->name('store');
        Route::get('/{id}/edit', [ReservationController::class, 'menuEdit'])->name('edit');
        Route::put('/{id}', [ReservationController::class, 'menuUpdate'])->name('update');
        Route::delete('/{id}', [ReservationController::class, 'menuDestroy'])->name('destroy');
    });
});

// ============================================
// FALLBACK / 404
// ============================================

Route::fallback(function () {
    return view('errors.404');
});