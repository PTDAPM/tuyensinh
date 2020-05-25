<?php

use Illuminate\Database\Seeder;

class NganhSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('nganhs')->insert([
            ['ten' => 'CCTT kỹ thuật xây dựng','ma_xet_tuyen' => 'TLA201'],
            ['ten' => 'CCTT kỹ thuật tài nguyên nước','ma_xet_tuyen' => 'TLA202'],
            ['ten' => 'kỹ thuật xây dựng công trình thuỷ','ma_xet_tuyen' => 'TLA101',]
            
            
        ]);
    }
}
