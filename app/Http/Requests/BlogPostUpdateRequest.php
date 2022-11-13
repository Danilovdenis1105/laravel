<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogPostUpdateRequest extends FormRequest
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
            'post.slug' => 'max:200',
            'post.excerpt' => 'max:500',
            'post.content_raw' => 'required|string|min:5|max:10000',
            'post.category_id' => 'required|integer|exists:blog_categories,id',
            'post.is_published' => 'integer'
        ];
    }
}
