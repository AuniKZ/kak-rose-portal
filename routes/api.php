<?php

use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\BookingController;

// Public routes
Route::get('/services', [ServiceController::class, 'index']);

// Protected routes (Require login)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/availability', [BookingController::class, 'checkAvailability']);
    Route::post('/bookings', [BookingController::class, 'store']);
});