<?php

namespace App\Http\Requests\Admin\Invoices;

use Illuminate\Foundation\Http\FormRequest;

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


    public function rules()
    {
        return [
            "customer_id" => "required|exists:customers,id",
            "invoice_amount" => "required|min:1",
            "invoice_date" => [
                'required',
                'date',
                'before_or_equal:' . now()->toDateString(),
            ],
        ];
    }

    public function messages()
    {
        return [
            "customer_id.required" => "Please choose customer" ,
            "invoice_amount.required" => "Invoice amount is required" ,
            "invoice_date.required" => "Invoice date is required" ,
            "invoice_date.date" => "Invoice date should be valid date" ,
            "invoice_date.before_or_equal" => "Invoice date mustn't be future date"
        ];
    }
}
