<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Songs extends Model
{
    use HasFactory;
    protected $table = 'song';
    public $timestamps = false;
    protected $fillable = [
        'songId',
        'usersId',
        'action',
        'elementId'
    ];
}
