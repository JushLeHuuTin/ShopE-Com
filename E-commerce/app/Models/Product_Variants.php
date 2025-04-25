<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Variants extends Model
{
    use HasFactory;

    protected $table = 'product_variants'; // Tên bảng
    protected $primaryKey = 'id_variant'; // Khóa chính tùy chỉnh

    public $timestamps = true; // Có sử dụng created_at, updated_at

    protected $fillable = [
        'id_product',
        'stock',
        'price',
        'size',
        'color'
    ];

    // Quan hệ với bảng Product (nếu có)
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
