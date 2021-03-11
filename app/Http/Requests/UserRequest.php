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
            'name' => 'required|min:5|max:50',
            'username' => 'required|min:5|max:50|unique:users',
            'roles' => 'required',
            'phone' => 'required|digits_between:10,12',
            'address' => 'required|min:20|max:200',
            'avatar' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ];
    }
}
