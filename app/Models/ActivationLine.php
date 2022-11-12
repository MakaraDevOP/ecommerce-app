<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivationLine extends Model
{
    use HasFactory;
    protected $table ='activationlines';
    protected $fillable = [
        'activation_id',
        'product_is',
        'term_id',
        'period',
        'activation_date',
        'expired_date',
        'note',
        'order_by',
        'is_notify_email',
        'is_free',
        'is_active'
    ];
}