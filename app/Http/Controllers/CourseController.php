<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function addCourse(Request $request){//teacher creates a course
        $teacher = $request->user();
        $validatedData = $request->validated();
        $course = Course::create([
            "name"=>$validatedData["name"],
            "classroom" => $validatedData["classroom"],
            "amount" => $validatedData["amount"],
            "teacher_id"=>$teacher->id,
            "difficulty_id" =>$validatedData["difficulty_id"],
        ]);
        return response()->json($course);
    }
}
