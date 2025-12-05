<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

abstract class Policy
{
    protected static string $permissionEnum;

    /**
     * Retrieves a permission enum constant by its name.
     *
     * This method dynamically resolves permission constants from the child class's
     * permission enum using the constant name. It validates that the constant exists
     * before attempting to retrieve it.
     *
     * @param string $case The name of the permission constant (e.g., 'VIEW_ANY', 'CREATE')
     *
     * @return PermissionEnum The resolved permission enum constant
     */
    private static function getPermission(string $case): PermissionEnum
    {
        throw_if(
            blank(static::$permissionEnum),
            sprintf('Permission enum class is not configured in "%s".', static::class)
        );

        $constantName = static::$permissionEnum . '::' . $case;

        throw_unless(
            defined($constantName),
            sprintf('Permission constant "%s" is not defined.', $constantName)
        );

        return constant($constantName);
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can(self::getPermission('VIEW_ANY'));
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Model $model): bool
    {
        return $user->can(self::getPermission('VIEW'));
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can(self::getPermission('CREATE'));
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Model $model): bool
    {
        return $user->can(self::getPermission('UPDATE'));
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Model $model): bool
    {
        return $user->can(self::getPermission('DELETE'));
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Model $model): bool
    {
        return $user->can(self::getPermission('RESTORE'));
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Model $model): bool
    {
        return $user->can(self::getPermission('FORCE_DELETE'));
    }
}
