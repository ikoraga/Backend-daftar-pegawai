<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeesController;


Route::post('login', [App\Http\Controllers\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('employees', [EmployeesController::class, 'index']);
    Route::post('employees', [EmployeesController::class, 'store']);
    Route::get('employees/{id}', [EmployeesController::class, 'show']);
    Route::put('employees/{id}', [EmployeesController::class, 'update']);
    Route::delete('employees/{id}', [EmployeesController::class, 'destroy']);
    Route::post('employees/{id}/photo', [EmployeesController::class, 'uploadPhoto']);
});
