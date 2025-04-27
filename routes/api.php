<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DepartmentController;

// FOR AUTHENTICATION
Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login'])->middleware('throttle:10,1');
    Route::post('check/email', [AuthController::class, 'check_email']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('logout', [AuthController::class, 'logout']);
    });
});

// FOR STATISTICS & METRICS
Route::prefix('metrics')->group(function () {
    Route::get('schools', [SchoolController::class, 'count']);
    Route::get('departments', [DepartmentController::class, 'count']);
    Route::get('programs', [ProgramController::class, 'count']);
    Route::get('students', [StudentController::class, 'count']);
});

// FOR IMPORTATION
Route::prefix('import')->group(function () {
    Route::post('students', [StudentController::class, 'import']);
});

// FOR API RESOURCES
Route::apiResource('schools', SchoolController::class);
Route::apiResource('departments', DepartmentController::class);
Route::apiResource('programs', ProgramController::class);
Route::apiResource('students', StudentController::class);
