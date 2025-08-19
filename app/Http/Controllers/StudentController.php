<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function createStudent(StoreStudentRequest $request){
        $validatedData = $request->validated();
        $student = Student::create([
            "name"=>$validatedData["name"],
            "last_name"=>$validatedData["last_name"],
            "phone_number"=>$validatedData["phone_number"],
            "email"=>$validatedData["email"],
            "password"=>Hash::make($validatedData['password']),     
        ]);
        return response()->json([
            "message"=>"Student Account created succesfully",
            "Student"=>"{$student->name} {$student->last_name}"
        ]);
    }
    public function loginStudent(Request $request){
        $validateForm = $request->validate([
            'email'=>'required|string|email',
            'password'=>'required|string'
        ]);   
        $student = Student::where('email', $request->email)->first();

         // Check password manually
        if (!$student || !Hash::check($request->password, $student->password)) {
            return response()->json("Wrong email or password", 401);
        }
        $token = $student->createToken('login_token')->plainTextToken;
        return response()->json([
            "message"=>"Login success",
            'token'=>$token
         ]);   
    }
    
    public function logoutStudent(Request $request){
        $student = Auth::user();
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message'=>'Logged out successfully'],200);
    }
    public function addCourse($courseId){
        $student = Auth::user();
        $studentWallet = $student->wallet;
        $course = Course::findOrFail($courseId);
        if($studentWallet->value < $course->amount){
            return response()->json([
                "message"=>"Not enough money for the course"
            ]);
        }
        $studentWallet->value -=$course->amount;
        $studentWallet->save();
        $student->courses->attach($courseId);
        return response()->json([
            "message"=>"Course added successfully"
        ]);


    }
}
