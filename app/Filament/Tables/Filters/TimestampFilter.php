<?php

namespace App\Filament\Tables\Filters;

use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class TimestampFilter extends Filter
{
    public static function make(?string $name = null): static
    {
        $from = $name . '_from';
        $to = $name . '_to';

        return parent::make($name)
            ->schema([
                DatePicker::make($from),
                DatePicker::make($to),
            ])
            ->query(function (Builder $query, array $data) use ($name, $from, $to) {
                return $query
                    ->when(
                        $data[$from],
                        fn ($query, $date) => $query->whereDate($name, '>=', $date),
                    )
                    ->when(
                        $data[$to],
                        fn ($query, $date) => $query->whereDate($name, '<=', $date),
                    );
            });
    }
}
