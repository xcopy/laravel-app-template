<?php

namespace App\Providers\Filament;

use Filament\Pages\Dashboard;
use Filament\Panel;

class AppPanelProvider extends PanelProvider
{
    protected static ?string $id = 'app';
    protected static ?string $path = 'app';
    protected static bool $default = true;

    public function panel(Panel $panel): Panel
    {
        return parent::panel($panel)
            //->domain(config('app.url'))
            ->pages([
                Dashboard::class,
            ])
            ->login()
            ->passwordReset()
            ->emailVerification()
            ->emailChangeVerification()
            ->profile();
    }
}
