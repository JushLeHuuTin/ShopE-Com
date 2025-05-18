<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table = 'discount_codes';

    protected $primaryKey = 'id_discount';
    public $timestamps = true;

    protected $fillable = [
        'code',
        'discount_value',
        'expiration_date',
        'max_uses',
        'created_at',
        'updated_at'
    ];
}
