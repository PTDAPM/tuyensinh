<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nganh extends Model
{
    //
    protected $table = 'nganhs';
    public function nguyenVong() {
    	return $this->hasMany('App\NguyenVong','id_nganh','id');
    }
    public function Tohop() {
    	return $this->belongsToMany('App\Tohop','nganh_tohops','ma_nganh','ma_to_hop');
    }
}
