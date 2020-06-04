<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diems', function (Blueprint $table) {
            $table->id();
            $table->integer('ma_nguyen_vong');
            $table->float('lop10_m1');
            $table->float('lop10_m2');
            $table->float('lop10_m3');
            $table->float('lop11_m1');
            $table->float('lop11_m2');
            $table->float('lop11_m3');
            $table->float('lop12_m1');
            $table->float('lop12_m2');
            $table->float('lop12_m3');


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
        Schema::dropIfExists('diems');
    }
}
