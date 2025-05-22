<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $table = 'promotions';
    protected $primaryKey = 'id_discount';

    // protected $fillable = [
    //     'name',
    //     'id_category',
    //     'is_featured',
    //     'description',
    //     'image_url',
    // ];
    public function product(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_promotion');
    }
}
