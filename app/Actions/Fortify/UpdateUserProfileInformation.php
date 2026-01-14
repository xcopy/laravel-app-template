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
        $hasUsernameAttribute = User::hasUsernameAttribute();

        $rules = [
            'name' => $this->nameRules(),
            'email' => $this->emailRules($user),
        ];

        if ($hasUsernameAttribute) {
            $rules['username'] = $this->usernameRules($user);
        }

        Validator::make($input, $rules)->validateWithBag('updateProfileInformation');

        if ($hasUsernameAttribute) {
            $attributes['username'] = $input['username'];
        }

        $attributes = [
            'name' => $input['name'],
            'email' => $input['email'],
        ];

        if ($input['email'] !== $user->email && $user instanceof MustVerifyEmail) {
            $attributes['email_verified_at'] = null;
        }

        $user->forceFill($attributes)->save();
    }
}
