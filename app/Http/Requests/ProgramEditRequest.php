<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProgramEditRequest extends FormRequest
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
            'program_id' => 'required' , 
            'department_id' => 'required',
            'program_name' => 'required|string',
            'program_acronym' 	=> 'required|string' , 
            'program_type' => 'required|string',
            'duration' => "required|digits:1",
            'description' => 'nullable|string'
        ];
    }
}
