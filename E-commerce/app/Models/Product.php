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
        return $this->belongsTo(category::class, 'id_category', 'id_category');
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
    public function scopeFeatured($query, $limit = 8)
    {
        return $query->with('defaultVariant')
                     ->where('is_featured', 1)
                     ->take($limit);
    }
    public static function searchByKeyword($keyword)
{
    return self::when($keyword, function ($query) use ($keyword) {
            $query->where('name', 'like', '%' . $keyword . '%')
                  ->orWhere('description', 'like', '%' . $keyword . '%');
        })
        ->paginate(8)
        ->appends(['s' => $keyword]);
}
}
