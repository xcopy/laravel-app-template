<?php

namespace App\Support;

use Spatie\OneTimePasswords\Support\PasswordGenerators\OneTimePasswordGenerator;

class AlphanumericPasswordGenerator extends OneTimePasswordGenerator
{
    public function generate(): string
    {
        return fake()->text($this->numberOfCharacters);
    }
}
