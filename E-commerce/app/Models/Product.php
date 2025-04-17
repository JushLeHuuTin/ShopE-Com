<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id_product';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'id_category',
        'is_featured',
        'description',
        'image_url',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category', 'id_category');
    }
    // Nếu chỉ lấy 1 giá mặc định 
    public function defaultVariant()
    {
        return $this->hasOne(Product_Variants::class, 'id_product', 'id_product')->orderBy('price', 'asc');
    }
    
}