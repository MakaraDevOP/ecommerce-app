<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table ='notes';
    protected $dates = [ 'deleted_at' ];
    protected $fillable = [
        'activation_id',
        'activation_line_id',
        'user_id',
        'title',
        'body',
    ];
}