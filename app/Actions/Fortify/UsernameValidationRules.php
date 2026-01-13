<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Validation\Rule;

trait UsernameValidationRules
{
    /**
     * Get the validation rules for the username field.
     *
     * Returns an array of validation rules that ensure the username is required,
     * is a string, does not exceed 255 characters, and is unique in the users table
     * (excluding the current user if provided).
     *
     * @param User|null $user Optional user instance to exclude from uniqueness check
     * @return array<int, mixed> The validation rules for username
     */
    protected function usernameRules(?User $user = null): array
    {
        return [
            'required',
            'string',
            'lowercase',
            'regex:/^[a-zA-Z0-9](?!.*[_.]{2})[a-zA-Z0-9_.]*[a-zA-Z0-9]$/', // alpha-numeric, underscore and dot allowed, no consecutive/leading/trailing dots or underscores
            'max:255',
            Rule::unique('users')->ignore($user?->id)
        ];
    }
}
