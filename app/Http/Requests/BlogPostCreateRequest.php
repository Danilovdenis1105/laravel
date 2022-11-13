<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogPostCreateRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'post.title' => 'required|min:3|max:200',
            'post.slug' => 'string|max:200|nullable',
            'post.excerpt' => 'string|max:500|nullable',
            'post.content_raw' => 'required|string|min:5|max:10000',
            'post.category_id' => 'required|integer|exists:blog_categories,id',
            'post.is_published' => 'integer'
        ];
    }

    /**
     * Get the errors messages for the defined validation rules
     *
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Enter post title',
            'content_raw.min' => 'Min length :min charges',
        ];
    }

    /**
     * Get custom attributes for validator errors
     *
     * @return string[]
     */
    public function attributes(): array
    {
        return [
            'title' => 'Title'
        ];
    }
}
