<?php

use Illuminate\Database\Seeder;
use App\Models\Products;
use App\Models\Tags;
use App\Models\TagsProductsCountModel;
class ProductTagsRelationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('eu_US');
        DB::table('products-tags')->delete();



        for($i = 1; $i < 101; $i++){

        $product_id = $faker->numberBetween($min = 1, $max = 20);
        $tag_id = $faker->numberBetween($min = 1, $max = 20);

                DB::table('products-tags')->insert([
                    'id' => $i,
                    'product_id' => $product_id,
                    'tag_id' => $tag_id,
                    'created_at' => date("Y-m-d H:i:s"),
                ]);
        }
    }
}
