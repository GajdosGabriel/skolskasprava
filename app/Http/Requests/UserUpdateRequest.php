<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
//        if(auth()->user()->hasRole(2) OR auth()->user()->hasRole(3)) {
            return [
                'email' => 'required', Rule::unique('users')->ignore($this->id),
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'psc' => 'required|string|max:200',
                'street' => 'required|string|max:255',
            ];
//        }


//            if(auth()->user()->hasRole(1)) {
//                return [
//                    'email' => 'required',  Rule::unique('users')->ignore($this->id),
//                    'first_name' => 'required|string|max:255',
//                    'last_name' => 'required|string|max:255',
//                    'company' => 'required|string|max:255',
//                    'city' => 'required|string|max:255',
//                    'psc' => 'required|string|max:200',
//                    'street' => 'required|string|max:255',
//                    'ico' => 'required|string|max:8',
//                ];
//            }


    }


    public function messages()
    {
        return [
            'first_name.required' => 'Meno je povinné.',
            'last_name.required' => 'Priezvisko je povinné.',
            'mesto.required' => 'Mesto je povinné.',
            'psc.required' => 'PSČ je povinné.',
            'street.required' => 'Ulica je povinná.',
            'company.required' => 'Názov školy je povinná.',
            'ico.required' => 'IČO organizácie je povinné.',
            'email.required' => 'Email už existuje.',
            'email' => 'Email je povinný.'

        ];
    }
}
