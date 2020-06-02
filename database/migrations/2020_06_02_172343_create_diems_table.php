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
            $table->integer('ma_ho_so');
            $table->integer('ma_nguyen_vong');
            $table->float('10_1');
            $table->float('10_2');
            $table->float('10_3');
            $table->float('11_1');
            $table->float('11_2');
            $table->float('11_3');
            $table->float('12_1');
            $table->float('12_2');
            $table->float('12_3');


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
