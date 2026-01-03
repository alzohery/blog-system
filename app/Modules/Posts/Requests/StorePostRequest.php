<?php

namespace App\Modules\Posts\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Modules\Posts\Models\Post;

/**
 * Handle validation for creating post
 */
class StorePostRequest extends FormRequest
{
    /**
     * Authorization logic
     */
    public function authorize(): bool
    {
        return true; // Admin middleware already applied
    }

    /**
     * Validation rules
     */
    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|string|max:255',
            'slug'        => 'nullable|string|max:255|unique:posts,slug',
            // 'content'     => 'required|array',
            'content' => 'required|string',
            'main_image'  => 'nullable|image|mimes:jpg,jpeg,png|max:9048',


            'status' => 'required|in:' . implode(',', [
                Post::STATUS_DRAFT,
                Post::STATUS_SCHEDULED,
                Post::STATUS_PUBLISHED,
            ]),

            'publish_at' => 'nullable|date|after:now',
        ];
    }

    /**
     * Custom validation messages (optional but clear)
     */
    public function messages(): array
    {
        return [
            'category_id.required' => 'Category is required.',
            'category_id.exists'   => 'Selected category does not exist.',

            'publish_at.after' => 'Publish date must be in the future.',
        ];
    }
}
