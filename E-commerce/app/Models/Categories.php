<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id_category';
    public $timestamps = true;
    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
    ];
}
