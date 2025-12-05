<?php

namespace App\Providers\Filament;

use App\Contracts\Blameable;
use App\Contracts\SoftDeletable;
use App\Filament\Tables\Columns\TimestampColumn;
use App\Filament\Tables\Filters\TimestampFilter;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider as BasePanelProvider;
use Filament\QueryBuilder\Constraints\RelationshipConstraint;
use Filament\QueryBuilder\Constraints\RelationshipConstraint\Operators\IsRelatedToOperator;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\Width;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\Middleware\ShareErrorsFromSession;

abstract class PanelProvider extends BasePanelProvider
{
    protected static ?string $id = null;
    protected static ?string $path = null;
    protected static bool $default = true;

    public function boot(): void
    {
        // table common options
        Table::configureUsing(function (Table $table): void {
            $table
                ->paginationPageOptions([10, 25, 50])
                ->defaultPaginationPageOption(25)
                ->defaultSort('id', 'desc');
        });

        // table common columns
        Table::macro('timestampColumns', function () {
            $columns = [];
            $table = call_user_func([$this->getModel(), 'make'])->getTable();

            foreach (['created_at', 'updated_at', 'deleted_at'] as $column) {
                if (!Schema::hasColumn($table, $column)) {
                    continue;
                }

                $columns[] = TimestampColumn::make($column);
            }

            return $this->pushColumns($columns);
        });

        // table common filters
        Table::macro('commonFilters', function () {
            /** @var Model $model */
            $model = call_user_func([$this->getModel(), 'make']);
            $filters = [];

            if ($model instanceof Blameable) {
                $filters[] = QueryBuilder::make()
                    ->constraints([
                        RelationshipConstraint::make('creator')
                            ->selectable(
                                IsRelatedToOperator::make()
                                    ->titleAttribute('name')
                                    ->searchable()
                                    ->multiple()
                            ),
                    ]);
            }

            if ($model instanceof SoftDeletable) {
                $filters[] = TrashedFilter::make();
            }

            if (method_exists($model, 'getCreatedAtColumn')) {
                $filters[] = TimestampFilter::make($model->getCreatedAtColumn());
            }

            /*
            if (method_exists($model, 'getUpdatedAtColumn')) {
                $filters[] = TimestampFilter::make($model->getUpdatedAtColumn());
            }
            */

            return $this->pushFilters($filters);
        });
    }

    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id(static::$id)
            ->path(static::$path)
            ->default(static::$default)
            ->colors([
                'primary' => Color::Indigo,
            ])
            ->topNavigation()
            ->maxContentWidth(Width::Full)
            ->middleware(static::getMiddlewares())
            ->authMiddleware(static::getAuthMiddlewares());
    }

    protected static function getMiddlewares(): array
    {
        return [
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            AuthenticateSession::class,
            ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            SubstituteBindings::class,
            DisableBladeIconComponents::class,
            DispatchServingFilamentEvent::class,
        ];
    }

    protected static function getAuthMiddlewares(): array
    {
        return [
            Authenticate::class,
        ];
    }
}
