<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{ Model, Relations\BelongsTo };

/**
 * The Cart Model.
 * 
 * @api
 * @final
 * @version 1.1.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 * 
 * @property integer $id
 * @property integer $product_id
 * @property integer $consumer_id
 * @property integer $quantity
 * @property Product $product
 */
final class Cart extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @since 1.0.0
     * @var array<int, string>
     */
    protected $fillable = [
        'product_id',
        'consumer_id',
        'quantity'
    ];

    /**
     * Retrieves the relation to the related product.
     * 
     * @api
     * @final
     * @since 1.1.0
     * @version 1.0.0
     *
     * @return BelongsTo
     */
    public final function product(): BelongsTo {
        return $this->belongsTo(Product::class);
    }
}
