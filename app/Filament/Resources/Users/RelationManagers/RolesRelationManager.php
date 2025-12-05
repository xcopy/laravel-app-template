<?php

namespace App\Filament\Resources\Users\RelationManagers;

use App\Filament\Resources\Roles\RoleResource;
use Filament\Resources\RelationManagers\RelationManager;

class RolesRelationManager extends RelationManager
{
    protected static string $relationship = 'roles';

    protected static ?string $relatedResource = RoleResource::class;
}
