<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
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

    public function invoiceDetails()
    {
        return $this->hasMany(InvoicesDetail::class, 'id_invoice', 'id_invoice');
    }

}
