<?php

namespace Database\Seeders;

use App\Enums\Permissions\Media;
use App\Enums\Permissions\Permission;
use App\Enums\Permissions\Role as RoleEnum;
use App\Enums\Permissions\User as UserEnum;
use App\Enums\Roles;
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
                    Roles::ADMIN->value,
                    Roles::MEDIA_MANAGER->value,
                    Roles::PERMISSION_MANAGER->value,
                    Roles::ROLE_MANAGER->value,
                    Roles::USER_MANAGER->value,
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
                    Roles::ADMIN->value
                ],
                [
                    Media::VIEW_ANY->value,
                    Media::VIEW->value,
                    Permission::VIEW_ANY->value,
                    Permission::VIEW->value,
                    RoleEnum::VIEW_ANY->value,
                    RoleEnum::VIEW->value,
                    UserEnum::VIEW_ANY->value,
                    UserEnum::VIEW->value,
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
