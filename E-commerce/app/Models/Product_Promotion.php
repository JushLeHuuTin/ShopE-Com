<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Model;
use Illuminate\Notifications\Notifiable;

class Product_Promotion extends Model
{
    protected $table = 'product_promotion';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'id_product', 'id_promotion'
    ];

    // Relationships
    // public function product()
    // {
    //     return $this->belongsTo(Product::class, 'id_product', 'id_product');
    // }
    
}
