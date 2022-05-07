<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{ Model };

/**
 * The Cart Model.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 * 
 * @property integer $id
 * @property integer $product_id
 * @property integer $consumer_id
 * @property integer $quantity
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
}
