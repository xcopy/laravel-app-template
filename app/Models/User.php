<?php

namespace App\Models;

use App\Contracts\Blameable;
use App\Contracts\SoftDeletable;
use App\Enums\RolesEnum;
use App\Notifications\VerifyEmail as VerifyEmailNotification;
use App\Notifications\ResetPassword as ResetPasswordNotification;
use App\Policies\UserPolicy;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\OneTimePasswords\Models\Concerns\HasOneTimePasswords;
use Spatie\Permission\Traits\HasRoles;

#[UsePolicy(UserPolicy::class)]
class User extends Authenticatable implements
    Auditable,
    Blameable,
    FilamentUser,
    HasMedia,
    MustVerifyEmail,
    SoftDeletable
{
    use AuditableTrait;
    use BlameableTrait;
    use HasFactory;
    use HasOneTimePasswords;
    use HasRoles;
    use InteractsWithMedia;
    use Notifiable;
    use SoftDeletes;
    use TwoFactorAuthenticatable;

    // protected array $auditInclude = [];
    // protected array $auditExclude = [];

    /**
     * The attributes that are mass-assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'active' => 'boolean',
        ];
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            // get: fn (string $value) => Str::title($value),
            set: fn (string $value) => Str::title($value),
        );
    }

    protected function username(): Attribute
    {
        return Attribute::make(
            // get: fn (string $value) => Str::lower($value),
            set: fn (string $value) => Str::lower($value),
        );
    }

    protected function email(): Attribute
    {
        return Attribute::make(
            // get: fn (string $value) => Str::lower($value),
            set: fn (string $value) => Str::lower($value),
        );
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return match ($panel->getId()) {
            'admin' => $this->hasRole(RolesEnum::ADMIN),
            'app' => true, // todo
            default => false,
        };
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->performOnCollections('avatars')
            ->width(100)
            ->height(100);
    }

    /**
     * {@inheritDoc}
     */
    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new VerifyEmailNotification());
    }

    /**
     * {@inheritDoc}
     */
    public function sendPasswordResetNotification(#[\SensitiveParameter] $token): void
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
