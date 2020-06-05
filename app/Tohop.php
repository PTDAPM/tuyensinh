<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tohop extends Model
{
    //
    protected $table = 'tohops';
    public function nganh() {
    	return $this->belongsToMany('App\Nganh','nganh_tohops','ma_to_hop','ma_nganh');
    }
}
