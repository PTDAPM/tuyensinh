<?php

use Illuminate\Database\Seeder;

class ToHopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         DB::table('tohops')->insert([
            ['ten' => 'A00'],
            ['ten' => 'A01'],
            ['ten' => 'D07'],
            ['ten' => 'D01'],
            
            
        ]);
    }
}
