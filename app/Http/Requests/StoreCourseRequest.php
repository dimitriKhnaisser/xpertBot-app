<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
         return [
            'name'=>'required|string|max:255',
            'classroom'=>'required|string|max:255',
            'amount'=>'required|integer',
            'teacher_id'=>"required|exists:teachers,id",//the teacher who created the course is the teacher
            'difficulty_id'=>"required|exists:difficulties,id"//difficulty should be chosen in arguments
        ];
    }
}
