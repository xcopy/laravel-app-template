<?php

namespace App\Enums\Permissions;

enum Media: string implements PermissionEnum
{
    use PermissionEnumTrait;

    case VIEW = 'view media';
    case VIEW_ANY = 'view any media';
    case CREATE = 'create media';
    case UPDATE = 'update media';
    case DELETE = 'delete media';
    case RESTORE = 'restore media';
    case FORCE_DELETE = 'force delete media';
}
