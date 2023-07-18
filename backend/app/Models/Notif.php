<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notif extends Model
{
    use HasFactory;

    protected $table = 'notif';

    protected $fillable = [
        'notif',
        'login_time'
    ];

    public $timestamps = false;


}
