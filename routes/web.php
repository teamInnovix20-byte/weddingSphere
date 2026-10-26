<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PortalController;
use Illuminate\Support\Facades\Route;

// Home goes straight to the sign-in page
Route::redirect('/', '/login');

// Page 1: unified sign-in
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');

// Page 2: portal selection (Bride/Groom or Vendor)
Route::get('/portal', [PortalController::class, 'index'])->name('portal.index');
Route::get('/portal/{type}', [PortalController::class, 'choose'])
    ->whereIn('type', ['couple', 'vendor'])
    ->name('portal.choose');

// Dashboard / Guest List & RSVP Command Center
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/guests', function () {
    return view('dashboard');
})->name('guests.index');

// Profile & Settings (frontend only)
Route::get('/profile', [AccountController::class, 'profile'])->name('profile.show');

Route::redirect('/settings', '/settings/security');
Route::get('/settings/{section}', [AccountController::class, 'settings'])
    ->whereIn('section', ['security', 'notifications', 'connected', 'billing', 'sessions'])
    ->name('settings.show');
// Admin: vendor application list (frontend preview only)
Route::view('/admin/vendor-applications', 'admin.vendor-applications')->name('admin.vendor-applications');
Route::view('/home', 'home')->name('home');
Route::view('/vendors', 'vendors.explore')->name('vendors.explore');