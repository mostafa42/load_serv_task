<?php

namespace App\Http\Requests\Admin\Customers;

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
            "name" => "required" ,
            "phone" => "required|unique:customers" ,
            "email" => "required|unique:customers"
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "Customer name is required" ,
            "phone.required" => "Customer phone is required" ,
            "phone.unique" => "Customer phone is already taken" ,
            "email.required" => "Customer email is required" ,
            "email.unique" => "Customer email is already taken"
        ];
    }
}
