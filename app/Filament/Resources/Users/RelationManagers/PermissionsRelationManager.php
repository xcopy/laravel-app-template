<?php

namespace App\Filament\Resources\Users\RelationManagers;

use App\Filament\Resources\Permissions\PermissionResource;
use Filament\Resources\RelationManagers\RelationManager;

class PermissionsRelationManager extends RelationManager
{
    protected static string $relationship = 'permissions';
    // protected static ?string $title = 'Direct permissions';

    protected static ?string $relatedResource = PermissionResource::class;
}
