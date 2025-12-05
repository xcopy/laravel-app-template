<?php

namespace App\Providers\Filament;

use App\Filament\Resources\Media\MediaResource;
use App\Filament\Resources\Permissions\PermissionResource;
use App\Filament\Resources\Roles\RoleResource;
use App\Filament\Resources\Users\UserResource;
use Filament\Navigation\NavigationGroup;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;

class AdminPanelProvider extends PanelProvider
{
    protected static ?string $id = 'admin';
    protected static ?string $path = 'admin';
    protected static bool $default = false;

    public function panel(Panel $panel): Panel
    {
        return parent::panel($panel)
            ->navigationGroups([
                NavigationGroup::make(__('Access Control')),
            ])
            ->pages([
                Dashboard::class,
            ])
            ->resources([
                MediaResource::class,
                PermissionResource::class,
                RoleResource::class,
                UserResource::class,
            ])
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
            ]);
    }
}
