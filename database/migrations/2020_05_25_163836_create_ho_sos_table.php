<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoSosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ho_sos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('ho_ten');
            $table->integer('gioi_tinh');
            $table->dateTime('ngay_thang_nam_sinh');
            $table->string('noi_sinh');
            $table->string('dan_toc');
            $table->string('cmnd');
            $table->dateTime('ngay_cap');
            $table->string('noi_cap');
            $table->string('ho_khau');
            $table->integer('ma_tinh');
            $table->integer('ma_huyen');
            $table->integer('ma_xa');
            $table->string('anh_hoc_ba');
            $table->string('sdt');
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
        Schema::dropIfExists('ho_sos');
    }
}
