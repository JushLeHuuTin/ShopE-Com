<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'shipping_addresses';
    protected $primaryKey = 'id_address';
    public $timestamps = true;
    protected $fillable = [
        'id_user',
        'full_name',
        'phone',
        'address',
        'default_address',
        'created_at',
        'updated_at',
    ];
}