<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lop10 extends Model
{
    //
    protected $table = 'lop10s';
    public function hoSo() {
    	return $this->hasMany('App\HoSo','ma_ho_so','id');
    }
}
