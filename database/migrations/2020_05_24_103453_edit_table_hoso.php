<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditTableHoso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('ho_sos', function($table)
        {
            $table->string('std');
            $table->string('email');
            $table->string('dia_chi');
            $table->string('nam_tot_nghiep');
            $table->string('kv_uu_tien');
            $table->string('doi_tuong_uu_tien')->nullable();
            $table->integer('trang_thai')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
