<?php

namespace App\Modules\Categories\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Handle validation for creating category
 */
class StoreCategoryRequest extends FormRequest
{
    /**
     * Authorization logic
     */
    public function authorize(): bool
    {
        return true; // Admin middleware already protects this route
    }

    /**
     * Validation rules
     */
    public function rules(): array
    {
        return [
            'name'      => 'required|string|max:255|unique:categories,name',
            'slug'      => 'nullable|string|max:255|unique:categories,slug',
            'is_active' => 'nullable|boolean',
        ];
    }
}
