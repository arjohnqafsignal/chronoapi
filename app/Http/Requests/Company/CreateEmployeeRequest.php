<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class CreateEmployeeRequest extends FormRequest
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
            'employee_id' => 'required',
            'first_name' => 'required|max:50',
            'middle_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'email' => 'required|email|unique:employees',
            'birthdate' => 'required',
            'gender' => 'required|max:50'
        ];
    }
}
