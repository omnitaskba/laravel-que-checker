<?php

namespace Omnitask\LaravelQueChecker\Models;

use Illuminate\Database\Eloquent\Model;

class QueHeartbeat extends Model
{
    public $fillable = [
        'status'
    ];

    public static $_STATUS_PENDING = 1;
    public static $_STATUS_CHECKED = 2;
    public static $_STATUS_FAILED = 3;

}
