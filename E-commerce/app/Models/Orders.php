<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model 
{
    protected $table = 'invoices';
    protected $primaryKey = 'id_invoice';
    public $timestamps = true;

    protected $fillable = [
        'id_user',
        'id_discount',
        'total_amount',
        'invoice_date',
        'status',
        'cancellation_reason',
        'payment_method',
    ];
}