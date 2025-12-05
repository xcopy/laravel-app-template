<?php

namespace App\Filament\Tables\Columns;

use Closure;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class TimestampColumn extends TextColumn
{
    protected bool $isDateTime = true;

    protected string|Htmlable|Closure|null $placeholder = '-';

    protected bool|Closure $isSortable = true;

    protected bool|Closure $isToggleable = true;

    protected bool|Closure $isToggledHiddenByDefault = true;

    public function getSortColumns(Model $record): array
    {
        return [$this->getName()];
    }
}
