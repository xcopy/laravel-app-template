<?php

namespace App\Filament\Resources\Roles\Tables;

use App\Filament\Tables\Columns\IdColumn;
use App\Filament\Tables\Columns\NameColumn;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RolesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                IdColumn::make(),
                NameColumn::make()
                    ->grow(),
                TextColumn::make('guard_name')
                    ->searchable()
                    ->sortable(),
            ])
            ->recordActions([
                EditAction::make()->iconButton(),
                DeleteAction::make()->iconButton(),
            ])
            ->recordUrl(
                fn ($record): string => route('filament.admin.resources.roles.view', compact('record'))
            )
            ->timestampColumns()
            ->commonFilters();
    }
}
