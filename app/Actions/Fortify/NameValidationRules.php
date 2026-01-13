<?php

namespace App\Actions\Fortify;

trait NameValidationRules
{
    /**
     * Get the validation rules for the name field.
     *
     * Returns an array of validation rules that ensure the name is required,
     * is a string, and does not exceed 255 characters.
     *
     * @return array<int, mixed> The validation rules for name
     */
    protected function nameRules(): array
    {
        return ['required', 'string', 'max:255'];
    }
}
