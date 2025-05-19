<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoicesDetail extends Model
{
    protected $table = 'invoices_detail';
    protected $primaryKey = 'id_invoice_detail';
    public $timestamps = true;
    protected $fillable = [
        'id_invoice',
        'id_variant',
        'quantity',
        'price',
        'created_at',
        'updated_at',
    ];
    
}