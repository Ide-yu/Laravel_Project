<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('posts')->insert([
        'user_id' => 1,
        'image_id' => 1,
        'area_id' => 1,
        'comment' => 'サンプル1',
        'date' => '2022-01-01',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),

        ]);
        //
    }
}
