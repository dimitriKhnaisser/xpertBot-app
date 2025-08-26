<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\ExamController;
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
    Route::post('student/addCourse/{courseId}',[StudentController::class,'addCourse']);//student enrolles to a course using his wallet money
    Route::post('student/addWallet',[StudentController::class,'addToWallet']);//student adds money his wallet
    Route::post('student/addJob/{jobId}',[StudentController::class,'addJob']);//student choose and get a job
    Route::get('student/getCompany',[StudentController::class,'getCompany']);//get the company that the student belongs to
    
});
Route::post('teacher/course/{courseId}/exam',[ExamController::class,'addExamToCourse']);//the teacher adds an exam to  a course
Route::post('teacher/question/{quesitonId}/answer',[AnswerController::class,'addAnswer']);//the teacher is adding an answer to a question
Route::post('teacher/exam/{examId}/question',[ExamController::class,'addQuestion']);//the teacher is adding an quesiton to an exam

Route::get('question/{quesitonId}/answers',[AnswerController::class,'answersOfQuestion']);//gets all the possible answers of a question
Route::middleware(['auth:sanctum', 'is_teacher'])->group(function () {

});

