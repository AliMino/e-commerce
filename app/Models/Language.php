<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * The Language Model.
 * 
 * @api
 * @final
 * @version 1.1.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class Language extends Model {

    /**
     * Indicates if the model should be timestamped.
     *
     * @override
     * @since 1.0.0
     * @var boolean $timestamps
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @since 1.1.0
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'code'
    ];
}
