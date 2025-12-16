<?php

namespace App\Notifications;

use Illuminate\Contracts\Queue\ShouldQueue;
use Spatie\OneTimePasswords\Notifications\OneTimePasswordNotification as BaseOneTimePassword;

class OneTimePassword extends BaseOneTimePassword implements ShouldQueue
{
    // potentially add support for SMS
}
