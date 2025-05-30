<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id_product';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'id_category',
        'is_featured', 
        'description',
        'image_url',
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'id_category', 'id_category');
    }
    //hàm chỉ lấy 1 giá mặc định 
    public function defaultVariant()
    {
        return $this->hasOne(Product_Variant::class, 'id_product', 'id_product')->orderBy('price', 'asc');
    }
    public function product_Variants()
    {
        return $this->hasMany(product_Variant::class, 'id_product', 'id_product');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class, 'id_product', 'id_product');
    }


}