<?php

namespace App\Filament\Tables\Columns;

use Closure;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Contracts\Support\Htmlable;

class NameColumn extends TextColumn
{
    protected string|Htmlable|Closure|null $label = 'Name';

    protected bool|Closure $isSearchable = true;

    protected bool|Closure $isSortable = true;

    protected ?array $sortColumns = ['name'];

    protected bool $shouldTranslateLabel = true;

    public static function getDefaultName(): ?string
    {
        return 'name';
    }
}
