<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Operation;
use Illuminate\Validation\Rules\Password;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->required(),
                        TextInput::make('username')
                            ->required(),
                        TextInput::make('email')
                            ->email()
                            ->required(),
                    ]),
                Section::make()
                    ->schema([
                        TextInput::make('password')
                            ->password()
                            ->required()
                            ->rule(Password::default())
                            ->visibleOn(Operation::Create),
                        Grid::make()
                            ->schema([
                                TextInput::make('new_password')
                                    ->password()
                                    ->label(__('New Password'))
                                    ->nullable()
                                    ->rule(Password::default())
                                    ->dehydrated(false),
                                TextInput::make('new_password_confirmation')
                                    ->password()
                                    ->label(__('Confirm New Password'))
                                    ->rule('required', fn ($get) => !!$get('new_password'))
                                    ->same('new_password')
                                    ->dehydrated(false),
                            ])
                            ->visibleOn(Operation::Edit),
                        SpatieMediaLibraryFileUpload::make('avatar')
                            ->image()
                            ->collection('avatars'),
                        Toggle::make('active')
                            ->required()
                            ->default(true),
                    ]),
            ]);
    }
}
