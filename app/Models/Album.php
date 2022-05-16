<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;
    protected $table = 'album';
    public $timestamps = false;
    protected $fillable = [
        'albumId',
        'usersId',
        'action',
        'elementId'
    ];
}
