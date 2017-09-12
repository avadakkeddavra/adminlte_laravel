<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User as UserModel;
class Update extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = $this->route('user');

        return \Auth::user()->can('update', $user);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
         'user_name' => 'max:191'
        ];
        if (\Auth::user()->can('change-role', $this->route('user'))) {
            $rules['user_role'] = 'sometimes|in:' . implode(',', [UserModel::ROLE_ADMIN, UserModel::ROLE_USER]);
        }

        return $rules;
    }
}
