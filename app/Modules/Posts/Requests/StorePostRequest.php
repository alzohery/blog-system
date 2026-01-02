<?php

namespace App\Modules\Posts\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    /**
     * Allow only authenticated admins
     */
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    /**
     * Validation rules for updating a post
     */
    public function rules(): array
    {
        $postId = $this->route('post')->id ?? null;

        return [
            'category_id' => ['required', 'exists:categories,id'],
            'title'       => ['required', 'string', 'max:255'],
            'slug'        => ['required', 'string', 'max:255', 'unique:posts,slug,' . $postId],
            'content'     => ['required', 'array'],
            'main_image'  => ['nullable', 'string', 'max:255'],
            'status'      => ['nullable', 'in:draft,scheduled,published'],
            'publish_at'  => ['nullable', 'date'],
        ];
    }

    /**
     * Inject admin_id automatically
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'admin_id' => auth('admin')->id(),
        ]);
    }
}
