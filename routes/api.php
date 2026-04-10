<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DeviceController;
use App\Http\Controllers\Api\DeviceHistoryController;
use App\Http\Controllers\Api\Payroll\EmployeeController;
use App\Http\Controllers\Api\UserController;
use App\Models\Payroll\Employee;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/users', [UserController::class, 'all']);
    Route::get('/employees', [EmployeeController::class, 'index']);
    Route::get('/employees/search', [EmployeeController::class, 'search']);

    Route::prefix('/devices')->group(function(){
        Route::get('/', [DeviceController::class, 'index']);
        Route::get('/by-type', [DeviceController::class, 'indexByType']);
        Route::get('/{id}', [DeviceController::class, 'show']);
        Route::post('/', [DeviceController::class, 'store']);
        Route::put('/{id}', [DeviceController::class, 'update']);
        Route::delete('/{id}', [DeviceController::class, 'destroy']);
    });

    Route::prefix('/histories')->group(function(){
        Route::post('/', [DeviceHistoryController::class, 'store']);
        Route::put('/{id}', [DeviceHistoryController::class, 'update']);
        // Route::delete('/{id}', [DeviceHistoryController::class, 'destroy']);
    });
});
    
Route::post('/login', [AuthController::class, 'login']);

Route::get('/test', function(){
    return response()->json([
        "message" => "success"
    ], 200);
});