<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnswerRequest;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class AnswerController extends Controller
{   
    public function addAnswer(StoreAnswerRequest $request,$questionId){//teacher can add/create answers
        $validatedData = $request->validated();
        $answer = Answer::create([
            "about"=>$validatedData["about"],
            "correct"=>$validatedData["correct"],
            "question_id"=>$questionId
        ]);
        $question = Question::findOrfail($questionId);
        return response()->json([
            "Question"=>"{$question->about}",
            "Answer"=>"{$answer->about}",
        ]);
    }
    public function answersOfQuestion($questionId){//get all the answers of a question, the possible answers of a question
        $question = Question::findOrFail($questionId);
        $answers = $question->answers;
        return response()->json([
            "Answers"=>$answers,
        ]);
    }

    //student chooses an answer done in student controller DONE

}
