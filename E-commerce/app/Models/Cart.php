<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';
    protected $primaryKey = 'id_cart';
    public $timestamps = true;

    protected $fillable = [
        'id_user', 
        'session_id',
        'id_variant',
        'quantity',
        'price',
        'added_at',
        'created_at',
        'updated_at',
    ];
}