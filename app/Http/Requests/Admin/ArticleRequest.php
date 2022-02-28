<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'title'       => 'required',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'required|image|mimes:png,jpeg,svg,jpg',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules['image'] = 'image|mimes:png,jpeg,svg,jpg';
        }

        return $rules;

    }//end of rules

}//end of request
