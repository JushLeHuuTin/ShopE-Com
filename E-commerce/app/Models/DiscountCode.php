<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscountCode extends Model
{
    protected $table = 'discount_codes'; // nếu bảng tên là discount_codes
    protected $primaryKey = 'id_discount';
    public $timestamps = false; // nếu bảng không có created_at, updated_at
}
