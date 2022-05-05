<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{ Model };

/**
 * The Product Model.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class Product extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @since 1.0.0
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'vat_included',
        'current_quantity',
        'store_id'
    ];
}
