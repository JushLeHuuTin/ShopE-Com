<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    // Khai báo tên bảng nếu không theo quy tắc số nhiều
    protected $table = 'cart';

    protected $primaryKey = 'id_cart';

    public $timestamps = false;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'id_user',
        'session_id',
        'id_variant',
        'quantity',
        'price',
        'added_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function variant()
    {
        return $this->belongsTo(Product_Variant::class, 'id_variant', 'id_variant');

    }
}
