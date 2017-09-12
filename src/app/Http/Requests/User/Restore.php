<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class restore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = $this->route('user');

        return \Auth::user()->can('restore', $user);

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
