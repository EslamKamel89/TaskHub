<?php

use App\Http\Controllers\Api\TenantDebugController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('/debug-tenant')->group(function () {
    Route::get('/check', [TenantDebugController::class, 'checkTenant']);
});
