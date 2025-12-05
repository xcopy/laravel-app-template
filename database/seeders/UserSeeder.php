<?php

namespace Database\Seeders;

use App\Enums\MediaPermissionsEnum;
use App\Enums\PermissionPermissionsEnum;
use App\Enums\RolePermissionsEnum;
use App\Enums\RolesEnum;
use App\Enums\UserPermissionsEnum;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                [
                    'name' => 'Kairat Jenishev',
                    'username' => 'kairat',
                    'email' => 'kairat.jenishev@gmail.com',
                    'password' => 'xx',
                    'email_verified_at' => now(),
                ],
                [
                    RolesEnum::ADMIN->value,
                    RolesEnum::MEDIA_MANAGER->value,
                    RolesEnum::PERMISSION_MANAGER->value,
                    RolesEnum::ROLE_MANAGER->value,
                    RolesEnum::USER_MANAGER->value,
                ],
                [
                    //
                ]
            ],
            [
                [
                    'name' => 'Admin',
                    'username' => 'admin',
                    'email' => 'admin@example.com',
                    'password' => 'xx',
                    'email_verified_at' => now(),
                ],
                [
                    RolesEnum::ADMIN->value
                ],
                [
                    MediaPermissionsEnum::VIEW_ANY->value,
                    MediaPermissionsEnum::VIEW->value,
                    PermissionPermissionsEnum::VIEW_ANY->value,
                    PermissionPermissionsEnum::VIEW->value,
                    RolePermissionsEnum::VIEW_ANY->value,
                    RolePermissionsEnum::VIEW->value,
                    UserPermissionsEnum::VIEW_ANY->value,
                    UserPermissionsEnum::VIEW->value,
                ]
            ]
        ];

        foreach ($items as [$attributes, $roles, $permissions]) {
            $user = User::create($attributes);
            $user->assignRole($roles);
            $permissions and $user->givePermissionTo($permissions);
        }

        User::factory()
            ->withoutTwoFactor()
            ->count(10)
            ->create();
    }
}
