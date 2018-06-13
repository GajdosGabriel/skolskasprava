<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequestUpdate extends FormRequest
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
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'grade_id' => 'required',
        ];
    }


    public function messages()
    {
        return [
            'first_name.required' => 'Meno musí byť vyplnené.',
            'last_name.required' => 'Priezvisko musí byť vyplnené.',
            'grade_id.required' => 'Treida musí byť uvedená.'

        ];
    }
}
