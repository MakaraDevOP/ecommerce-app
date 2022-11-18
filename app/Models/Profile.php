<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'phone',
        'date_of_birth',
        'place_of_birth',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
