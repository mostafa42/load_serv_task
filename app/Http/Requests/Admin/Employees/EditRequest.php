<?php

namespace App\Http\Requests\Admin\Employees;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditRequest extends FormRequest
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
            "image" => "image",
            "name" => "required",
            "phone" =>  [
                Rule::unique('users')->ignore($this->route('employee')),
            ],
            "email" => [
                Rule::unique('users')->ignore($this->route('employee')),
            ],
        ];
    }

    public function messages()
    {
        return [
            "image.image" => "Employee image should image file",
            "name.required" => "Employee name is required",
            "phone.required" => "Employee phone is required",
            "phone.unique" => "Employee phone is already taken",
            "email.required" => "Employee email is required",
            "email.unique" => "Employee email is already taken",
        ];
    }
}
