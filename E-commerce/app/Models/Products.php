<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
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
        return $this->belongsTo(Categories::class, 'id_category', 'id_category');
    }
}