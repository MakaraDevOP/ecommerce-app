<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activation extends Model
{
    use HasFactory;
    protected $table ='activations';
    protected $fillable = [
        'customer_id',
        'details',
        'is_active'
    ];
}