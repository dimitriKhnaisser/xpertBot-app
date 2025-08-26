<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Models\Course;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;

class ExamController extends Controller
{

    public function addExamToCourse($courseId){
        $exam = Exam::create([
            "grade"=>30,
            "course_id"=>$courseId,
        ]);
        $couse = Course::findOrFail($courseId);
        return response()->json([
            "course"=>$couse,
            "exam's grade"=>$exam->grade,
        ]);

    }
    public function addQuestion(StoreQuestionRequest $request,$examId){
        $exam = Exam::findOrFail($examId);
        $validatedQuestion = $request->validated();
        $question = Question::create([
            "about"=>$validatedQuestion["about"],
            "grade"=>1,
            "exam_id"=>$examId,
        ]);
        return response()->json([
            "Exam Course"=>$exam->course,
            "Question "=>$exam->questions,
        ]);
    }
}
