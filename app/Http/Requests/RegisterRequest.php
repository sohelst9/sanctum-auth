<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' =>'required',
            'email' =>'email|required|unique:users,email',
            'password' => 'required|confirmed'
        ];
    }

    //---custom message ---
    public function messages()
    {
        return [
            'name.required' => "Enter Your Full Name",
            'email.required' => "Email is Required",
            'password' => "Password is Required",
            'password.confirmed' => "Confirm Password Does Not match"
        ];
    }
}
