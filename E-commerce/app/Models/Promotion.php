<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Promotion extends Model
{
    protected $table = 'Promotions';
    protected $primaryKey = 'id_promotion';
    public $timestamps = true;

  protected $fillable = [
        'name',
        'discount_value',
        'start_date',
        'end_date'
    ];

    public function products():BelongsToMany
    {
        return $this->BelongsToMany(Product::class, 'product_promotion','id_promotion','id_product');
    }
 
}