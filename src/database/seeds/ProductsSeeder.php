<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('eu_US');
        $admin_id = DB::table('users')->where('role_id','=',2)->take(1)->get();
        $admin_id = $admin_id[0]->id;

        $user_id = DB::table('users')->where('role_id','=',1)->take(1)->get();
        $user_id = $user_id[0]->id;
        DB::table('products')->delete();

        for($i = 0;$i < 10;$i++)
        {
            DB::table('products')->insert([
                'id'   => $i+1,
                'name' => $faker->name,
                'price' => $faker->randomDigitNotNull,
                'description' => $faker->text($maxNbChars = 191),
                'user_id' => $admin_id,
                'created_at' => $faker->dateTimeThisYear($max = 'now', $timezone = date_default_timezone_get()),
            ]);

        }
        for($i = 10; $i < 20; $i++){
            DB::table('products')->insert([
                'id'   => $i+1,
                'name' => $faker->name,
                'price' => $faker->randomDigitNotNull,
                'description' => $faker->text($maxNbChars = 191),
                'user_id' => $user_id,
                'created_at' => $faker->dateTimeThisYear($max = 'now', $timezone = date_default_timezone_get()),
            ]);


        }



    }
}
