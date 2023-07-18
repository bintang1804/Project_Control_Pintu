<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iot extends Model
{
    use HasFactory;

    protected $table = 'iot';

    protected $fillable = [
        'card',
        'nama',
        'login_time'
    ];

    public $timestamps = false;
}
