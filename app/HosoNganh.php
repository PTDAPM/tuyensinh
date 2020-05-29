<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HosoNganh extends Model
{
    //
    protected $table = 'hoso_nganhs';
    public function nganh() {
    	return $this->hasMany('App\Nganh', 'ma_nganh', 'id');
    }
  
}
