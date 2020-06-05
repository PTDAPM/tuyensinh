<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NguyenVong extends Model
{
    //
    protected $table = 'nguyen_vongs';
    public function toHop() {
    	return $this->hasOne('App\ToHop', 'ma_to_hop', 'id');
    }
}
