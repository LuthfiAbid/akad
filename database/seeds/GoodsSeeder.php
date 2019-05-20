<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Goods;
// use Faker\Generator as Faker;

class GoodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $faker = Faker::create();
        // foreach(range(0,10) as $i){
            factory(Goods::class, 10)->create()->each(function ($p){
            //   $num_originals = 3;
            //   $original_files_folder = 'productImages/food';
            //         // randomly select an image
            // $pathToFile = $original_files_folder . random_int(1, $num_originals) . '.jpg';
            // // add it to the product through the media library
            // $p->addMedia($pathToFile)->preservingOriginal()->toMediaCollection('product', 'product');
            });
        }
    }
// }
