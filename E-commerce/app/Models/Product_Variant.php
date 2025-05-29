<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Model;
use Illuminate\Notifications\Notifiable;

class Product_Variant extends Model
{
    protected $table = 'product_variants';
    protected $primaryKey = 'id_variant';
    public $timestamps = true;

    protected $fillable = [
        'id_product', 'stock', 'price', 'size', 'color'
    ];

    // Relationships
    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product', 'id_product');
    }

    
    // Quan hệ với Cart
    public function carts()
    {
        return $this->hasMany(Cart::class, 'id_variant', 'id_variant');
    }
    
}
