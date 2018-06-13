<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class StudentsParentsStoreRequest extends FormRequest
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
            'email' => 'unique:users,email',
        ];
    }

    public function store() {

        return User::create( array_merge($this->all(), [
            'email' => $this->input('email') ?? bcrypt('neuvedeny-email@'),
        ] ));

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
