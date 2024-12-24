<?php

namespace App\Http\Requests\Admin\Employees;

use Illuminate\Foundation\Http\FormRequest;

class AddRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "image" => "image" ,
            "name" => "required" ,
            "phone" => "required|unique:users" ,
            "email" => "required|unique:users" ,
            "password" => "required|min:6",
            "confirm_password" => "required|same:password"
        ];
    }

    public function messages()
    {
        return [
            "image.image" => "Employee image should image file" ,
            "name.required" => "Employee name is required" ,
            "phone.required" => "Employee phone is required" ,
            "phone.unique" => "Employee phone is already taken" ,
            "email.required" => "Employee email is required" ,
            "email.unique" => "Employee email is already taken" ,
            "password.required" => "Employee password is required" ,
            "password.min" => "Password should be grater than 6 letters" ,
            "confirm_password.required" => "Confirm password is required" ,
            "confirm_password.same" => "Password doesn't match",
        ];
    }
}
