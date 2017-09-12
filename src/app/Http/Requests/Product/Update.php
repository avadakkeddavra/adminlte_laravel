<?php

namespace App\Http\Requests\Product;

use App\Models\Products as ProductsModel;
use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::user()->can('update',ProductsModel::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'prod_name' => 'required|max:191',
            'prod_price' => 'required|max:11',
            'prod_desc' => 'max:191',
        ];
    }
}
