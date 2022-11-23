<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UploadFile extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table ='upload_files';
    protected $dates = [ 'deleted_at' ];
    protected $fillable = [
        'name',
        'file_path',
        'size',
        'type',
        'activation_id'
    ];
}