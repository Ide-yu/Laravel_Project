<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('comments')->insert([
        'user_id' => 1,
        'post_id' => 1,
        'res_comment' => 'テスト1',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),

        ]);
        //
    }
}
