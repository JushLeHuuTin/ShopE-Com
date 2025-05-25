<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ShippingAddress extends Model
{
    use HasFactory;

    // Đặt tên bảng nếu nó khác với tên mặc định
    protected $table = 'shipping_addresses';

    // Đặt khóa chính nếu nó không phải là 'id'
    protected $primaryKey = 'id_address';

    // Chỉ định các cột có thể gán hàng loạt
    protected $fillable = [
        'id_user', // Để phù hợp với khóa ngoại trong migration
        'full_name',
        'phone',
        'address',
        'default_address',
    ];

    // Tắt trường created_at và updated_at nếu bạn không sử dụng chúng
    // public $timestamps = false;

    // Định nghĩa mối quan hệ với User
     public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user'); //->onDelete('cascade');
    }
}
