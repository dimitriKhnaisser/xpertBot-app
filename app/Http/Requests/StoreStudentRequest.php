<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
            'last_name'=>'required|string|max:255',
            'phone_number'=>'required|string|unique:students,phone_number|max:255',
            'email'=>'required|string|unique:students,email|max:255|email',
            'password'=>'required|string|min:8|confirmed',
            'linkedin'=>'nullable|string|max:255',
            'github'=>'nullable|string|max:255',
        ];
    }
}
