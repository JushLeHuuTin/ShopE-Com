<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';
    protected $primaryKey = 'id_review';
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'id_product',
        'rating', 
        'comment',
    ];

    public function users()
    {
        return $this->belongsTo(Users::class, 'id_user', 'id_user');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product', 'id_product');
    }
}