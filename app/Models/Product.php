<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'products';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name',
        'type',
        'price',
        'stock',
        'description',
        'is_active'
    ];

    public function category()
    {
        return $this->hasOne(Type::class, 'id', 'type');
    }
}
