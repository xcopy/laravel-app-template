<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Validation\Rule;

trait EmailValidationRules
{
    /**
     * Get the validation rules for the email field.
     *
     * Returns an array of validation rules that ensure the email is required,
     * is a string, must be a valid email format, does not exceed 255 characters,
     * and is unique in the users table (excluding the current user if provided).
     *
     * @param User|null $user Optional user instance to exclude from uniqueness check
     * @return array<int, mixed> The validation rules for email
     */
    protected function emailRules(?User $user = null): array
    {
        return [
            'required',
            'string',
            'lowercase',
            'email',
            'max:255',
            Rule::unique('users')->ignore($user?->id)
        ];
    }
}
