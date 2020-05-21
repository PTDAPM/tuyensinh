<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNguyenVongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nguyen_vongs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('ma_ho_so');
            $table->string('ten');
            $table->float('diem');
            $table->integer('id_nganh');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nguyen_vongs');
    }
}
