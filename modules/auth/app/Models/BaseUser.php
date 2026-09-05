<?php

namespace Modules\Auth\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\Contracts\OAuthenticatable;
use Laravel\Passport\HasApiTokens;
use Laravel\Passport\Passport;
use Modules\Auth\Traits\HasPassportPasswordGrant;

class BaseUser extends Authenticatable implements OAuthenticatable
{
    use HasApiTokens, HasPassportPasswordGrant, HasUuids, Notifiable;

    public const ROLE_USER = 'user';

    public const ROLE_ADMIN = 'admin';

    public function socialConnections(): HasMany
    {
        return $this->hasMany(UserSocialConnection::class);
    }

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isSuperAdmin(): bool
    {
        return $this->is_super_admin === true;
    }

    /**
     * Resolve the password grant client (config or DB fallback).
     *
     * @return array{client_id: string|null, client_secret: string|null}
     */
    public static function resolvePasswordClient(): array
    {
        $config = config('auth.providers.users.passport', []);
        $clientId = $config['client_id'] ?? null;
        $clientSecret = $config['client_secret'] ?? null;

        if (!$clientId || !$clientSecret) {
            $client = Passport::client()
                ->newQuery()
                ->where('revoked', false)
                ->where('password_client', true)
                ->first();

            if ($client) {
                $clientId = $client->id;
                $clientSecret = $client->secret;
            }
        }

        return [
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
        ];
    }
}
