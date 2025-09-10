<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWalletRequest extends FormRequest
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
            'value'=>'nullable|integer'
        ];
    }
    protected function prepareForValidation()
    {
        $this->merge([
            'value' => $this->value ?? 0, // default value of 0
            'student_id'=>'required|exists:students,id'//the wallet will be created when a student is
        ]);
    }
}
