<?php

namespace App\Modules\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Authorization
     */
    public function authorize(): bool
    {
        return true; // All users are allowed to try logging in
    }

    /**
     * Validation rules
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ];
    }

    /**
     * Custom error messages
     */
    public function messages(): array
    {
        return [
            'email.required' => 'Please enter your email.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'Please enter your password.',
            'password.min' => 'Password must be at least 6 characters.',
        ];
    }
}
