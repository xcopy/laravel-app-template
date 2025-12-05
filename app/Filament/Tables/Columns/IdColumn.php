<?php

namespace App\Filament\Tables\Columns;

use Closure;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Contracts\Support\Htmlable;

class IdColumn extends TextColumn
{
    protected string|Htmlable|Closure|null $label = 'ID';

    protected bool|Closure $isSortable = true;

    protected ?array $sortColumns = ['id'];

    public static function getDefaultName(): ?string
    {
        return 'id';
    }
}
