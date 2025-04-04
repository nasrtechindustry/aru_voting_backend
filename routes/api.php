<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('schools/count' , [SchoolController::class , 'count']);
Route::get('departments/count' , [DepartmentController::class , 'count']);
Route::get('programs/count' , [ProgramController::class , 'count']);
Route::get('students/count' , [StudentController::class , 'count']);
Route::post('students/import' , [StudentController::class , 'import']);



Route::apiResource('schools' , SchoolController::class);
Route::apiResource('departments' , DepartmentController::class) ;
Route::apiResource('programs', ProgramController::class);
Route::apiResource('students', StudentController::class);

