<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class registerloginrequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
           'name'=>'required:3',
           'username'=>'required|string|min:4|unique:users',
           'email'=>'required|unique:users',
           'password'=>'required|string|min:3'
        ];
    }
}
