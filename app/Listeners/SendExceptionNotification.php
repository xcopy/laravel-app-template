<?php

namespace App\Listeners;

use App\Jobs\SendExceptionNotification as SendExceptionNotificationJob;
use Illuminate\Log\Events\MessageLogged;
use Throwable;

class SendExceptionNotification
{
    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(MessageLogged $event): void
    {
        $channels = logs()->getChannels();

        if (isset($channels['slack'])) {
            return;
        }

        $exception = $event->context['exception'] ?? null;
        $context = [];

        // Build exception context manually to avoid the "Serialization of 'Closure' is not allowed" issue
        // The MessageLogged event's context array may contain closures that cannot be serialized when queuing jobs
        if ($exception instanceof Throwable) {
            // Extract only serializable exception data into a plain array structure
            $context['exception'] = [
                'class' => get_class($exception),
                'message' => $exception->getMessage(),
                'code' => $exception->getCode(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'trace' => array_filter(
                    array_map(
                        fn (array $frame) => isset($frame['file'], $frame['line'])
                            ? $frame['file'] . ':' . $frame['line']
                            : null,
                        $exception->getTrace()
                    )
                ),
            ];
        }

        SendExceptionNotificationJob::dispatch($event->level, $event->message, $context);
    }
}
