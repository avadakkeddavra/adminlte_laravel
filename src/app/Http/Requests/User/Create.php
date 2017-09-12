<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class Create extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_name' => 'required|max:191',
            'user_email' => 'required|email|max:191',
            'user_password' => 'required|max:191',
            'user_role' => 'required'
        ];
    }
}
