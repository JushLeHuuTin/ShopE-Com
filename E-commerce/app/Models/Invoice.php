<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    protected $primaryKey = 'id_invoice';
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'id_discount',
        'total_amount',
        'invoice_date',
        'status',
        'cancellation_reason',
        'payment_method',
    ];

    protected $casts = [
        'invoice_date' => 'datetime',
        'total_amount' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function discount()
    {
        return $this->belongsTo(DiscountCode::class, 'id_discount');
    }

    public function details(): HasMany
    {
        return $this->hasMany(InvoiceDetail::class, 'id_invoice');
    }
    public function invoiceDetails(){
        return $this->hasMany(InvoicesDetail::class, 'id_invoice', 'id_invoice');
    }
}
