<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'apellidos' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|between:6,50',
            'cedula' => 'required|unique:users',
            'path' => 'required|file|max:10240',
            'edad' => 'required',
   
        ];
    }
}
