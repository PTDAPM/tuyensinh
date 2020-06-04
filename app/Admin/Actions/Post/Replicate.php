<?php

namespace App\Admin\Actions\Post;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class Replicate extends RowAction
{
    public $name = 'Edit';

    public function href()
    {
        return "./tin-tucs/sua-tin/".$this->getKey();
    }

}