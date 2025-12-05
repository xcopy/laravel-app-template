<?php

namespace App\Enums;

enum RolesEnum: string
{
    case ADMIN = 'admin';
    case MEDIA_MANAGER = 'media manager';
    case PERMISSION_MANAGER = 'permission manager';
    case ROLE_MANAGER = 'role manager';
    case USER_MANAGER = 'user manager';
}
