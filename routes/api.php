<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CarController;
use App\Http\Controllers\Api\V1\FullPurchaseController;
use App\Http\Controllers\Api\V1\PurchaseController;
use App\Http\Controllers\Api\V1\RentPurchaseController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware(['throttle:api'])->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});

Route::prefix('v1/cars/{car}')->middleware(['throttle:api', 'auth:sanctum'])->group(function () {
    Route::post('full-purchase', [FullPurchaseController::class, 'store']);
    Route::post('rent-purchase', [RentPurchaseController::class, 'store']);
});

Route::prefix('v1')->middleware(['throttle:api', 'auth:sanctum'])->group(function () {
    Route::apiResource('cars', CarController::class);
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::prefix('v1')->middleware(['throttle:api', 'auth:sanctum'])->group(function () {
    Route::apiResource('purchases', PurchaseController::class);
    Route::patch('purchases/{purchase}/rent-purchase', [RentPurchaseController::class, 'update']);
    Route::get('purchases/{purchase}/status', [PurchaseController::class, 'status']);
});
