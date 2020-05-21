<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLop11sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lop11s', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('ma_ho_so');
            $table->string('ten_truong');
            $table->string('dia_chi');
            $table->integer('ma_tinh');
            $table->integer('ma_truong');
            $table->float('diem_tb');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lop11s');
    }
}
