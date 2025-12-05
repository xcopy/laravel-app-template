<?php

namespace Database\Seeders;

use App\Enums\MediaPermissionsEnum;
use App\Enums\PermissionPermissionsEnum;
use App\Enums\RolePermissionsEnum;
use App\Enums\UserPermissionsEnum;
use App\Enums\RolesEnum;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            RolesEnum::ADMIN->value => [
                // ...
            ],
            RolesEnum::MEDIA_MANAGER->value => MediaPermissionsEnum::getPermissionNames(),
            RolesEnum::PERMISSION_MANAGER->value => PermissionPermissionsEnum::getPermissionNames(),
            RolesEnum::ROLE_MANAGER->value => RolePermissionsEnum::getPermissionNames(),
            RolesEnum::USER_MANAGER->value => UserPermissionsEnum::getPermissionNames(),
        ];

        foreach ($items as $role => $permissions) {
            $role = Role::findOrCreate($role);
            foreach ($permissions as $permission) {
                $permission = Permission::findOrCreate($permission);
                $role->givePermissionTo($permission);
            }
        }
    }
}
