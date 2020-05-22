<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nganh extends Model
{
    //
    protected $table = 'nganhs';
    public function nguyenVong() {
    	return $this->hasMany('App\NguyenVong','id_nganh','id')
    }
}
