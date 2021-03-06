<?php

namespace App\Http\Requests;

use App\Rules\GroupsList;
use Illuminate\Foundation\Http\FormRequest;

class RoutineRequest extends FormRequest
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
            'name' => 'required|min:3|max:30',
            'state' => 'required|boolean',
            'exec_at' => 'required|date_format:H:i',
            'groups' => ['required', new GroupsList()]
        ];
    }
}
