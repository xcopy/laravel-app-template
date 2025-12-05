<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\Filament\AdminPanelProvider::class,
    App\Providers\Filament\AppPanelProvider::class,
    App\Providers\FortifyServiceProvider::class,
    App\Providers\VoltServiceProvider::class,
    OwenIt\Auditing\AuditingServiceProvider::class,
    RichanFongdasen\EloquentBlameable\ServiceProvider::class,
];
