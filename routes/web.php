<?php

use App\Http\Controllers\Web\TenantDebugController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

Route::prefix('/debug-tenant')->group(function () {
    Route::get('/check', [TenantDebugController::class, 'checkTenant']);
    Route::get('/{publicId}', [TenantDebugController::class, 'debugTenant']);
});

require __DIR__ . '/settings.php';
