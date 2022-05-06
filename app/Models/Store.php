<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{ Model, Relations\BelongsTo, Relations\HasMany };

/**
 * The Store Model.
 * 
 * @api
 * @final
 * @version 1.1.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class Store extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'merchant_id',
        'vat_percentage'
    ];

    /**
     * Retrieves the relation to the related Merchant instance.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @return BelongsTo
     */
    public final function merchant(): BelongsTo {
        return $this->belongsTo(User::class, 'merchant_id');
    }

    /**
     * Gets the relation to the related products.
     * 
     * @api
     * @final
     * @since 1.1.0
     * @version 1.0.0
     *
     * @return HasMany
     */
    public final function products(): HasMany {
        return $this->hasMany(Product::class);
    }
}
