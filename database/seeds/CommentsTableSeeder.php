<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('ja_JP');
        for($i = 0; $i < 200; $i++) {
            App\Comment::create([
              'item_id' => $faker->numberBetween(1, 30), //1から30
               'user_id' => $faker->numberBetween(1, 3), //1〜3
               'content' => $faker->realText(150, 5),
               'created_at' => $faker->dateTime('now'), //現在までYmdHis
               'updated_at' => $faker->dateTime('now'), //現在までYmdHis
            ]);
       }
    }
}
