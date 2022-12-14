<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogCategoryUpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'category.title'       => 'required|min:5|max:200',
            'category.slug'        => 'string|max:200|nullable',
            'category.description' => 'string|max:500|min:3',
            'category.parent_id'   => 'required|integer|exists:blog_categories,id',
        ];
    }
}
