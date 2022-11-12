<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $table ='contacts';
    protected $fillable = [
        'company_id',
        'title',
        'full_name',
        'phone',
        'email',
        'is_active',
        'description'
    ];
}