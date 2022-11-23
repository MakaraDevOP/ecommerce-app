<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Profile extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'address',
        'phone',
        'date_of_birth',
        'place_of_birth',
    ];
    protected $dates = [ 'deleted_at' ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}