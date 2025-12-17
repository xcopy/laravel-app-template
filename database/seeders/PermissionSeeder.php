<?php

namespace Database\Seeders;

use App\Enums\Permissions\Media;
use App\Enums\Permissions\Permission as PermissionEnum;
use App\Enums\Permissions\Role as RoleEnum;
use App\Enums\Permissions\User;
use App\Enums\Roles;
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
            Roles::ADMIN->value => [
                // ...
            ],
            Roles::MEDIA_MANAGER->value => Media::values(),
            Roles::PERMISSION_MANAGER->value => PermissionEnum::values(),
            Roles::ROLE_MANAGER->value => RoleEnum::values(),
            Roles::USER_MANAGER->value => User::values(),
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
