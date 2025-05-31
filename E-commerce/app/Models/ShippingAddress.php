<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    protected $table = 'shipping_addresses';
    protected $primaryKey = 'id_address';
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'full_name',
        'phone',
        'address',
        'default_address'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
