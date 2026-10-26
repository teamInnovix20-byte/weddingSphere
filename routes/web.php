<?php

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

// Admin: vendor application list (frontend preview only)
Route::view('/admin/vendor-applications', 'admin.vendor-applications')->name('admin.vendor-applications');