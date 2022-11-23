<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activation extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table ='activations';
    protected $dates = [ 'deleted_at' ];
    protected $fillable = [
        'customer_id',
        'details',
        'is_active'
    ];
}