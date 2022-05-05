<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\{ Notifications\Notifiable, Foundation\Auth\User as Authenticatable };
use Illuminate\Database\Eloquent\{ Factories\HasFactory, Relations\BelongsTo, Relations\HasMany };

/**
 * The User Model.
 * 
 * @api
 * @final
 * @version 1.2.1
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class User extends Authenticatable {

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Retrieves the relation to the related Role instance.
     * 
     * @api
     * @final
     * @since 1.1.0
     * @version 1.0.0
     *
     * @return BelongsTo
     */
    public final function role(): BelongsTo {
        return $this->belongsTo(Role::class);
    }

    /**
     * Retrieves the relation to the related Stores instance (for merchants).
     * 
     * @api
     * @final
     * @since 1.2.0
     * @version 1.0.1
     *
     * @return HasMany
     */
    public final function stores(): HasMany {
        return $this->hasMany(Store::class, 'merchant_id');
    }

    /**
     * Checks whether this user is a merchant, or not.
     * 
     * @api
     * @final
     * @since 1.1.0
     * @version 1.0.0
     *
     * @return boolean
     */
    public final function isMerchant(): bool {
        return 'merchant' == $this->role->name;
    }

    /**
     * Checks whether this user is a consumer, or not.
     * 
     * @api
     * @final
     * @since 1.1.0
     * @version 1.0.0
     *
     * @return boolean
     */
    public final function isConsumer(): bool {
        return 'consumer' == $this->role->name;
    }
}
