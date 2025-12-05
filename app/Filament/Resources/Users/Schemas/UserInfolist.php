<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Models\User;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                SpatieMediaLibraryImageEntry::make('avatar')
                                    ->collection('avatars')
                                    ->square()
                                    ->circular()
                                    ->imageHeight(40)
                                    ->defaultImageUrl(
                                        fn (User $record): string => url('https://placehold.co/40?text=' . $record->initials())
                                    ),
                                TextEntry::make('name'),
                                TextEntry::make('username'),
                            ]),
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('email'),
                                TextEntry::make('email_verified_at')
                                    ->dateTime()
                                    ->placeholder('-'),
                                IconEntry::make('active')
                                    ->boolean(),
                            ]),
                    ]),
                Section::make()
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('created_at')
                                    ->dateTime()
                                    ->placeholder('-'),
                                TextEntry::make('updated_at')
                                    ->dateTime()
                                    ->placeholder('-'),
                                TextEntry::make('deleted_at')
                                    ->dateTime()
                                    ->placeholder('-'),
                            ]),
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('creator.name')
                                    ->label(__('Creator'))
                                    ->placeholder('-'),
                                TextEntry::make('updater.name')
                                    ->label(__('Updater'))
                                    ->placeholder('-'),
                                TextEntry::make('deleter.name')
                                    ->label(__('Deleter'))
                                    ->placeholder('-'),
                            ]),
                    ])
            ]);
    }
}
