<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTruongThptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('truong_thpts', function (Blueprint $table) {
            $table->id();
            $table->integer('ma_ho_so');
            $table->integer('ma_truong');
            $table->string('ten_truong');
            $table->string('dia_chi');
            $table->integer('ma_tinh');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('truong_thpts');
    }
}
