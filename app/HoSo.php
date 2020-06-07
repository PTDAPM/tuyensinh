<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HoSo extends Model
{
    //
    protected $table = 'ho_sos';
    const STATUS = [
        0 => "✘ Chưa Được Duyệt",
        1 => "✔ Đã Duyệt"
    ];
    const GIOITINH = [
        0 => "♂️ NAM",
        1 => "♀️ NỮ"
    ];
    public function nganh() {
    	return $this->belongsToMany('App\Nganh','hoso_nganhs','ma_ho_so','ma_nganh');
    }
    public function lop10() {
    	return $this->hasOne('App\Lop10');
    }
    public function lop11() {
    	return $this->hasOne('App\Lop11');
    }
    public function lop12() {
    	return $this->hasOne('App\Lop12');
    }
    public function nguyenvong() {
        return $this->hasMany('App\NguyenVong','ma_ho_so','id');
    }


}