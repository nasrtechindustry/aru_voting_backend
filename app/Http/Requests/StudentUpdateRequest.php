<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentUpdateRequest extends FormRequest
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
            'user_id' => 'required' , 
            'first_name' => 'required|string' , 
            'middle_name' => 'required|string' , 
            'last_name' => 'required|string' , 
            'registration_number' => 'required|string|size:12' , 
            'start_date' => 'required|date_format:Y-m-d' , 
            'end_date' => 'required|date_format:Y-m-d' , 
            'email' => 'required|email',
            'phone' => 'required|digits:10' , 
            'year' => 'required'
        ];
    }
}
