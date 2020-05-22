<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lop11 extends Model
{
    //
    protected $table = 'lop11s';
    public function hoSo() {
    	return $this->hasMany('App\HoSo','ma_ho_so','id');
    }
}
