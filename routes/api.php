<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\SchoolController;
use Illuminate\Support\Facades\Route;


Route::apiResource('schools' , SchoolController::class);
Route::apiResource('departments' , DepartmentController::class) ;
Route::apiResource('programs', ProgramController::class);
