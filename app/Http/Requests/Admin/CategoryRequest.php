<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => 'required|unique:categories',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $category = $this->route()->parameter('category');

            $rules['name'] = 'required|unique:categories,name,' . $category->id;
        }

        return $rules;

    }

}
