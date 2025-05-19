<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $table = 'product_variants';
    protected $primaryKey = 'id_variant';
    public $timestamps = true;
    protected $fillable = [
        'id_product',
        'stock',
        'price', 
        'size',
        'color',
        'created_at',
        'updated_at',
    ];
}