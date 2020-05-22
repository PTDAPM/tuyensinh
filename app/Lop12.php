<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lop12 extends Model
{
    //
    protected $table = 'lop12s';
    public function hoSo() {
    	return $this->hasMany('App\HoSo','ma_ho_so','id');
    }
}
