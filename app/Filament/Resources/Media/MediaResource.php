<?php

namespace App\Filament\Resources\Media;

use App\Filament\Resources\Media\Pages\ManageMedia;
use App\Filament\Tables\Columns\IdColumn;
use App\Filament\Tables\Columns\NameColumn;
use App\Models\Media;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MediaResource extends Resource
{
    protected static ?string $model = Media::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Photo;

    protected static ?string $recordTitleAttribute = 'name';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                IdColumn::make(),
                NameColumn::make()->grow(),
                TextColumn::make('file_name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('disk')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('collection_name')
                    ->label(__('Collection'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('mime_type')
                    ->label(__('Type'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('size')
                    ->formatStateUsing(fn ($record) => $record->human_readable_size)
                    ->sortable(),
                TextColumn::make('model_type')
                    ->label(__('Model'))
                    ->formatStateUsing(fn ($record) => sprintf('%s:%s', class_basename($record->model_type), $record->model_id))
                    ->sortable('model_type'),
            ])
            ->recordActions([
                DeleteAction::make(),
                ForceDeleteAction::make(),
                RestoreAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ])
            ->recordUrl(
                fn ($record) => $record->disk === 'public'
                    ? $record->getUrl()
                    : $record->getTemporaryUrl(),
                true
            )
            ->timestampColumns()
            ->commonFilters();
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageMedia::route('/'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
