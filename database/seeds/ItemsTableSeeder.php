<?php

use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('ja_JP');
        for($i = 0; $i < 30; $i++) {
            App\Item::create([
              'item_name' => $faker->word(), //文字列
               'user_id' => $faker->numberBetween(1, 3), //1〜3
               'created_at' => $faker->dateTime('now'), //現在までYmdHis
               'updated_at' => $faker->dateTime('now'), //現在までYmdHis
            ]);
       }

    }
}
