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
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|regex:/^[a-zA-Z0-9_.+-]+@(?:(?:[a-zA-Z0-9-]+\.)?[a-zA-Z]+\.)?(epitech)\.eu$/',
            'password' => 'same:password_confirm',
            'suspend' => 'required|boolean',
            'admin' => 'required|boolean',
        ];

        if($this->method() == 'POST')
            $rules['password'] = 'required|same:password_confirm';
        return $rules;
    }
}
