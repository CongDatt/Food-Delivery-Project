<?php

namespace App\Models;

use App\Builders\MerchantBuilder;
use App\Enums\RoleType;
use App\Traits\OverridesBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Merchant extends Authenticatable implements JWTSubject
{
    use HasFactory;
    use OverridesBuilder;

    public function provideCustomBuilder(): string
    {
        return MerchantBuilder::class;
    }
    protected $fillable = [
        'merchant_name', 'address', 'email', 'password',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->attributes['password'];
    }

    /**
     * @inheritDoc
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * @inheritDoc
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return 'email';
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        if ($this->roles->where('name', RoleType::ADMIN)->first()) {
            return true;
        }

        return false;
    }
    // ======================================================================
    // Accessors & Mutators
    // ======================================================================

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
