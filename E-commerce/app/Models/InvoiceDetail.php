<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceDetail extends Model
{
    // Tên bảng chính xác trong DB
    protected $table = 'invoices_detail';

    // Khóa chính
    protected $primaryKey = 'id_invoice_detail';

    // Không dùng timestamps
    public $timestamps = false;

    // Các cột được fill
    protected $fillable = [
        'id_invoice',
        'id_variant',
        'quantity',
        'price',
    ];

    // Định nghĩa kiểu dữ liệu
    protected $casts = [
        'price' => 'decimal:2',
    ];

    /**
     * Quan hệ đến Invoice
     */
    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class, 'id_invoice');
    }

    /**
     * Quan hệ đến Product Variant
     */
    public function variant(): BelongsTo
    {
        return $this->belongsTo(Product_Variant::class, 'id_variant');
    }
}
