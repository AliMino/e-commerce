<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{ Model, Relations\BelongsTo };

/**
 * The Product-Detail Model.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class ProductDetail extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @override
     * @since 1.0.0
     * @var array<int, string>
     */
    protected $fillable = [
        'product_id',
        'language_id',
        'name',
        'description',
        'price',
        'currency'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @override
     * @since 1.0.0
     * @var boolean $timestamps
     */
    public $timestamps = false;

    /**
     * Gets the relation to the parent product.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @return BelongsTo
     */
    public final function product(): BelongsTo {
        return $this->belongsTo(Product::class);
    }

    /**
     * Gets the relation to the language of this product detail instance.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @return BelongsTo
     */
    public final function language(): BelongsTo {
        return $this->belongsTo(Language::class);
    }
}
