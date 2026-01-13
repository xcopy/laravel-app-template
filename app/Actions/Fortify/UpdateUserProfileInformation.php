<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    use EmailValidationRules;
    use NameValidationRules;
    use UsernameValidationRules;

    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, string>  $input
     */
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'name' => $this->nameRules(),
            'username' => $this->usernameRules($user),
            'email' => $this->emailRules($user),
        ])->validateWithBag('updateProfileInformation');

        $attributes = [
            'name' => $input['name'],
            'username' => $input['username'],
            'email' => $input['email'],
        ];

        if ($input['email'] !== $user->email && $user instanceof MustVerifyEmail) {
            $attributes['email_verified_at'] = null;
        }

        $user->forceFill($attributes)->save();
    }
}
