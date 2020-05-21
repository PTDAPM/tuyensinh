<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNganhsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nganhs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('ten');
            $table->string('ma_xet_tuyen');
            $table->string('to_hop_xet_tuyen');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nganhs');
    }
}
