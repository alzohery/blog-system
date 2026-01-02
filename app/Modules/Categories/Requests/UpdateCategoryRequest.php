<?php

namespace App\Modules\Categories\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Handle validation for updating category
 */
class UpdateCategoryRequest extends FormRequest
{
    /**
     * Authorization logic
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules
     */
    public function rules(): array
    {
        return [
            'name'      => 'required|string|max:255|unique:categories,name,' . $this->category->id,
            'slug'      => 'nullable|string|max:255|unique:categories,slug,' . $this->category->id,
            'is_active' => 'nullable|boolean',
        ];
    }
}
