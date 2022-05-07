<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{ Collection, Model, Relations\BelongsTo, Relations\HasMany };

/**
 * The Product Model.
 * 
 * @api
 * @final
 * @version 1.2.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 * 
 * @property integer $id
 * @property boolean $vat_included
 * @property integer $current_quantity
 * @property integer $store_id
 * @property Store $store
 * @property Collection $details
 */
final class Product extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @since 1.0.0
     * @var array<int, string>
     */
    protected $fillable = [
        'vat_included',
        'current_quantity',
        'store_id'
    ];

    /**
     * Gets the relation to the store having this product.
     * 
     * @api
     * @final
     * @since 1.1.0
     * @version 1.0.0
     *
     * @return BelongsTo
     */
    public final function store(): BelongsTo {
        return $this->belongsTo(Store::class);
    }

    /**
     * Gets the relation to the prodect details.
     * 
     * @api
     * @final
     * @since 1.2.0
     * @version 1.0.0
     *
     * @return HasMany
     */
    public final function details(): HasMany {
        return $this->hasMany(ProductDetail::class);
    }
}
