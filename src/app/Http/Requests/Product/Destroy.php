<?php

namespace App\Http\Requests\Product;

use App\Models\Products as ProductsModel;
use Illuminate\Foundation\Http\FormRequest;

class Destroy extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::user()->can('destroy',ProductsModel::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        ];  //
    }
}
