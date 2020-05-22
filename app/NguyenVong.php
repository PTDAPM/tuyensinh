<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NguyenVong extends Model
{
    //
    protected $table = 'nguyen_vongs';
    public function hoSo() {
    	return $this->belongsToMany('App\HoSo','hoso_nguyenvongs','ma_nguyen_vong','ma_ho_so');
    }
    public function nganh() {
    	return $this->belongsTo('App\Nganh','id_nganh','id')
    }
}
