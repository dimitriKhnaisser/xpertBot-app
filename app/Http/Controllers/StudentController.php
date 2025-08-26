<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Models\Answer;
use App\Models\Course;
use App\Models\Job;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Wallet;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

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
        $wallet = Wallet::create([
            "value"=>0,
            "student_id"=>$student->id,
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
    public function addCourse(Request $request,$courseId){
        $student = request()->user();
        $studentWallet = $student->wallet;
        $course = Course::findOrFail($courseId);
        if($studentWallet->value < $course->amount){
            return response()->json([
                "message"=>"Not enough money for the course",
                "Your wallet"=>"{$studentWallet->value}"
            ]);
        }
        try{
            $student->courses()->attach($courseId);
            $studentWallet->value -=$course->amount;
            $studentWallet->save();
            return response()->json([
            "message"=>"Course added successfully",
            "Your wallet"=>"{$studentWallet->value}"
        ]);
        }catch(Exception $e){
            return response()->json([
                "message"=>$e,
            ],401);

        }
    }
    public function addToWallet(Request $request){
        $student = Auth::user();
        $wallet = $student->wallet;
        $value = $request->query('value');
        $wallet->value += $value;
        $wallet->save();
        return response()->json([
            "message"=>"{$value} is added",
            "Total"=> "{$wallet->value}"
        ]);
    }
    public function addJob($jobId){
        $student = Auth::user();
        if($student->job!=null){
             return response()->json([
                "message"=>"You already have a job!!",
                "Your Job"=>"{$student->job->name}"
            ],400);
        }
        $job = Job::findOrFail($jobId);
        if($job->student_id != null){
            $job->student_id = $student->id;
            $job->save();
            return response()->json([
                "message"=>"You got the job!!",
                "Your Job"=>"{$job->name}"
            ]);
            return response()->json([
                "message"=>"Job already taken!"
            ],400);
        }
    }
    public function getCompany(){
        $student = Auth::user();
        if($student->job == null){
             return response()->json([
                "message"=>"You do not belong to a company",
            ],400);
        }
        $job = $student->job;
        $company = $job->company;
         return response()->json([
                "Company"=>"{$company->name}",
            ],400);
    }
    public function studentChooseAnswer(Request $request,$answerId){
        $student = $request->user();
        $answer = Answer::findOrFail($answerId);
        $question = $answer->question;
        $student->answers()->attach($answerId);
        return response()->json([
            "Question"=>"{$question}",
            "Answer"=>"{$answer}",
        ]);

    }
}
