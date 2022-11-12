<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadFile extends Model
{
    use HasFactory;
    protected $table ='upload_files';
    protected $fillable = [
        'name',
        'file_path',
        'size',
        'type',
        'activation_id'
    ];
}