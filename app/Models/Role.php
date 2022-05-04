<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{ Model, Relations\HasMany };

/**
 * The User-Role Model.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class Role extends Model {
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @override
     * @since 1.0.0
     * @var boolean $timestamps
     */
    public $timestamps = false;

    /**
     * Retrieves the relation to the User instanes having this Role.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @return HasMany
     */
    public final function users(): HasMany {
        return $this->hasMany(User::class);
    }
}
