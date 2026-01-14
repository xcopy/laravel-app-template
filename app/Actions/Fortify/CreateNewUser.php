<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use EmailValidationRules;
    use NameValidationRules;
    use PasswordValidationRules;
    use UsernameValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        $hasUsernameAttribute = User::hasUsernameAttribute();

        $rules = [
            'name' => $this->nameRules(),
            'email' => $this->emailRules(),
            'password' => $this->passwordRules(),
        ];

        if ($hasUsernameAttribute) {
            $rules['username'] = $this->usernameRules();
        }

        Validator::make($input, $rules)->validate();

        $attributes = [
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => $input['password'],
        ];

        if ($hasUsernameAttribute) {
            $attributes['username'] = $input['username'];
        }

        return User::create($attributes);
    }
}
