<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HoSo extends Model
{
    //
    protected $table = 'ho_sos';
    public function lop10() {
    	return $this->belongsTo('App\Lop10','ma_ho_so','id');
    }
    public function lop11() {
    	return $this->belongsTo('App\Lop11','ma_ho_so','id');
    }
    public function lop12() {
    	return $this->belongsTo('App\Lop12','ma_ho_so','id');
    }
    public function nguyenVong() {
    	return $this->belongsToMany('App\NguyenVong','hoso_nguyenvongs','ma_ho_so','ma_nguyen_vong');
    }

}
