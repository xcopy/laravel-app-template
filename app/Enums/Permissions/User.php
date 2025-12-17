<?php

namespace App\Enums\Permissions;

enum User: string implements PermissionEnum
{
    use PermissionEnumTrait;

    case VIEW = 'view user';
    case VIEW_ANY = 'view any user';
    case CREATE = 'create user';
    case UPDATE = 'update user';
    case DELETE = 'delete user';
    case RESTORE = 'restore user';
    case FORCE_DELETE = 'force delete user';
}
