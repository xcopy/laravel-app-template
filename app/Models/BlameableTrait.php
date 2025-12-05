<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use RichanFongdasen\EloquentBlameable\BlameableService;
use RichanFongdasen\EloquentBlameable\BlameableTrait as BaseBlameableTrait;

trait BlameableTrait
{
    use BaseBlameableTrait;

    public function deleter(): BelongsTo
    {
        $service = app(BlameableService::class);

        return $this->belongsTo(
            $service->getConfiguration($this, 'user'),
            $service->getConfiguration($this, 'deletedBy')
        );
    }
}
