<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('areas')->insert([
        'area_name' => '東京',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),

      ]);
        
        //
    }
}
