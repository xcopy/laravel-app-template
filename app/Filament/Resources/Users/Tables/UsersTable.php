<?php

namespace App\Filament\Resources\Users\Tables;

use App\Filament\Tables\Columns\IdColumn;
use App\Filament\Tables\Columns\NameColumn;
use App\Models\User;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns(array_filter([
                IdColumn::make(),
                SpatieMediaLibraryImageColumn::make('avatar')
                    ->label(__('Avatar'))
                    ->collection('avatars')
                    ->square()
                    ->circular()
                    ->imageHeight(40)
                    ->defaultImageUrl(
                        fn (User $record): string => url('https://placehold.co/40?text=' . $record->initials())
                    ),
                NameColumn::make()
                    ->grow(),
                User::hasUsernameAttribute()
                    ? TextColumn::make('username')
                        ->searchable()
                        ->sortable()
                    : null,
                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                IconColumn::make('active')
                    ->boolean()
                    ->sortable(),
            ]))
            ->recordActions([
                EditAction::make()->iconButton(),
                DeleteAction::make()->iconButton(),
                ForceDeleteAction::make()->iconButton(),
                RestoreAction::make()->iconButton(),
            ])
            ->recordUrl(
                fn ($record): string => route('filament.admin.resources.users.view', compact('record'))
            )
            ->timestampColumns()
            ->commonFilters();
    }
}
