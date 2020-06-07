<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TinTuc extends Model
{
    //
    protected $table = 'tin_tucs';
    const STATUS = [
        0 => "✔ ENABLE",
        1 => "✘ DISABLE"
    ];
}
