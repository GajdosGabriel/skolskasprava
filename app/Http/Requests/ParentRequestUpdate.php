<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ParentRequestUpdate extends FormRequest
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
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
//            'email' => 'required|max:255',  Rule::unique('users')->ignore(auth()->user()->id),

        ];
    }


    public function messages()
    {
        return [
            'first_name.required' => 'Meno musí byť vyplnené.',
            'last_name.required' => 'Priezvisko musí byť vyplnené.',
            'email.required' => 'Email už používa niekto iný.',
        ];
    }
}
