<?php

use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('student/add',[StudentController::class,'createStudent']);

Route::post('student/login',[StudentController::class,'loginStudent']);
Route::middleware(['auth:sanctum', 'is_student'])->group(function () {
    Route::post('student/logout',[StudentController::class,'logoutStudent']);
    Route::post('student/addCourse/{courseId}',[StudentController::class,'addCourse']);//course as normal value
    Route::post('student/addWallet',[StudentController::class,'addToWallet']);//
    Route::post('student/addJob/{jobId}',[StudentController::class,'addJob']);//
    Route::get('student/getCompany',[StudentController::class,'getCompany']);//get the company that the student belongs to
    
});

