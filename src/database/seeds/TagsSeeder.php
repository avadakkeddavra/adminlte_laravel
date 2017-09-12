<?php

use Illuminate\Database\Eloquent\Factory;
use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('eu_US');
        DB::table('tags')->delete();
        for ($i = 0; $i < 20; $i++)
        {
            DB::table('tags')->insert([
                'id'         => $i+1,
                'tag_name'   => $faker->word,
                'created_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get())
            ]);
        }

    }
}
