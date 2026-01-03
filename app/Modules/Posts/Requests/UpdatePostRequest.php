<?php

namespace App\Modules\Posts\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Modules\Posts\Models\Post;

/**
 * Handle validation for updating post
 */
class UpdatePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|string|max:255',
            'slug'        => 'nullable|string|max:255|unique:posts,slug,' . $this->post->id,
            'content'     => 'required|string',

            'main_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'status' => 'required|in:' . implode(',', [
                Post::STATUS_DRAFT,
                Post::STATUS_SCHEDULED,
                Post::STATUS_PUBLISHED,
            ]),

            'publish_at' => 'nullable|date',
        ];
    }
}
