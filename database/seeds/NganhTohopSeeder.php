<?php

use Illuminate\Database\Seeder;

class NganhTohopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('nganh_tohops')->insert([
            ['ma_nganh' => 1, 'ma_to_hop' => 1],
            ['ma_nganh' => 1, 'ma_to_hop' => 2],
            ['ma_nganh' => 1, 'ma_to_hop' => 3],
            ['ma_nganh' => 1, 'ma_to_hop' => 4],
            ['ma_nganh' => 2, 'ma_to_hop' => 1],
            ['ma_nganh' => 2, 'ma_to_hop' => 2],
            ['ma_nganh' => 2, 'ma_to_hop' => 3],
            ['ma_nganh' => 2, 'ma_to_hop' => 4],
            
            
        ]);
    }
}
