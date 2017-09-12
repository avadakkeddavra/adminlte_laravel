<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('eu_US');

       DB::table('users')->delete();

       for($i = 0; $i < 3; $i++)
       {
           DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => Hash::make('48526'),
                'role_id' => $faker->randomElement($array = array(1,2)),
                'created_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get())
           ]);
       }

    }
}
