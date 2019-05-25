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
        $shirt = "productImages/shirt/";
        $num_originals = 6;

        DB::table('goods')->insert([
            'goods_name' => 'Caraway Top',
            'stock' => '12',
            'price' => '349000',
            'picture' => random_int(1,$num_originals).'.jpg',
            'id_admin' => rand($min = 1, $max = 2),
            'id_category' => '1',
        ]);

        DB::table('goods')->insert([
            'goods_name' => 'Kiva Top',
            'stock' => '12',
            'price' => '349000',
            'picture' => random_int(1,$num_originals).'.jpg',
            'id_admin' => rand($min = 1, $max = 2),
            'id_category' => '1',
       ]);

       DB::table('goods')->insert([
        'goods_name' => 'Lennox T-Shirt',
        'stock' => '12',
        'price' => '335000',
        'picture' => random_int(1,$num_originals).'.jpg',
        'id_admin' => rand($min = 1, $max = 2),
        'id_category' => '1',
        ]);

        DB::table('goods')->insert([
            'goods_name' => 'Chloe T-Shirt',
            'stock' => '12',
            'price' => '380000',
            'picture' => random_int(1,$num_originals).'.jpg',
            'id_admin' => rand($min = 1, $max = 2),
            'id_category' => '1',
            ]);
    

       DB::table('goods')->insert([
        'goods_name' => 'Kira T-Shirt',
        'stock' => '12',
        'price' => '240000',
        'picture' => random_int(1,$num_originals).'.jpg',
        'id_admin' => rand($min = 1, $max = 2),
        'id_category' => '1',
        ]);

        DB::table('goods')->insert([
            'goods_name' => 'Jenahara T-Shirt',
            'stock' => '12',
            'price' => '349000',
            'picture' => random_int(1,$num_originals).'.jpg',
            'id_admin' => rand($min = 1, $max = 2),
            'id_category' => '1',
        ]);

        DB::table('goods')->insert([
            'goods_name' => 'Vida Top',
            'stock' => '12',
            'price' => '240000',
            'picture' => random_int(1,$num_originals).'.jpg',
            'id_admin' => rand($min = 1, $max = 2),
            'id_category' => '1',
        ]);

        DB::table('goods')->insert([
            'goods_name' => 'Lawren Top',
            'stock' => '12',
            'price' => '349000',
            'picture' => random_int(1,$num_originals).'.jpg',
            'id_admin' => rand($min = 1, $max = 2),
            'id_category' => '1',
        ]);

        DB::table('goods')->insert([
            'goods_name' => 'Hira Top',
            'stock' => '12',
            'price' => '350000',
            'picture' => random_int(1,$num_originals).'.jpg',
            'id_admin' => rand($min = 1, $max = 2),
            'id_category' => '1',
        ]);

        DB::table('goods')->insert([
            'goods_name' => 'Sadie Top',
            'stock' => '12',
            'price' => '335000',
            'picture' => random_int(1,$num_originals).'.jpg',
            'id_admin' => rand($min = 1, $max = 2),
            'id_category' => '1',
        ]);

        DB::table('goods')->insert([
            'goods_name' => 'Valida Top',
            'stock' => '12',
            'price' => '240000',
            'picture' => random_int(1,$num_originals).'.jpg',
            'id_admin' => rand($min = 1, $max = 2),
            'id_category' => '1',
        ]);

        DB::table('goods')->insert([
            'goods_name' => 'Jolie Top',
            'stock' => '12',
            'price' => '380000',
            'picture' => random_int(1,$num_originals).'.jpg',
            'id_admin' => rand($min = 1, $max = 2),
            'id_category' => '1',
        ]);

//++++++++++++------------------------- Pants ------------------------------------+++++++++++++//
        DB::table('goods')->insert([
            'goods_name' => 'Mace Pants',
            'stock' => '12',
            'price' => '349000',
            'picture' => random_int(1,$num_originals).'.jpg',
            'id_admin' => rand($min = 1, $max = 2),
            'id_category' => '2',
        ]);
        DB::table('goods')->insert([
            'goods_name' => 'Earth Pants',
            'stock' => '12',
            'price' => '350000',
            'picture' => random_int(1,$num_originals).'.jpg',
            'id_admin' => rand($min = 1, $max = 2),
            'id_category' => '2',
        ]);
        DB::table('goods')->insert([
            'goods_name' => 'Bergamout Trousers',
            'stock' => '12',
            'price' => '335000',
            'picture' => random_int(1,$num_originals).'.jpg',
            'id_admin' => rand($min = 1, $max = 2),
            'id_category' => '2',
        ]);
        DB::table('goods')->insert([
            'goods_name' => 'Buttercup Pants',
            'stock' => '12',
            'price' => '240000',
            'picture' => random_int(1,$num_originals).'.jpg',
            'id_admin' => rand($min = 1, $max = 2),
            'id_category' => '2',
        ]);
        DB::table('goods')->insert([
            'goods_name' => 'DRU PANTS',
            'stock' => '12',
            'price' => '380000',
            'picture' => random_int(1,$num_originals).'.jpg',
            'id_admin' => rand($min = 1, $max = 2),
            'id_category' => '2',
        ]);
        DB::table('goods')->insert([
            'goods_name' => 'DACIA PANTS',
            'stock' => '12',
            'price' => '349000',
            'picture' => random_int(1,$num_originals).'.jpg',
            'id_admin' => rand($min = 1, $max = 2),
            'id_category' => '2',
        ]);
        DB::table('goods')->insert([
            'goods_name' => 'NEA PANTS',
            'stock' => '12',
            'price' => '240000',
            'picture' => random_int(1,$num_originals).'.jpg',
            'id_admin' => rand($min = 1, $max = 2),
            'id_category' => '2',
        ]);
        DB::table('goods')->insert([
            'goods_name' => 'Diera Pants',
            'stock' => '12',
            'price' => '349000',
            'picture' => random_int(1,$num_originals).'.jpg',
            'id_admin' => rand($min = 1, $max = 2),
            'id_category' => '2',
        ]);
        DB::table('goods')->insert([
            'goods_name' => 'Lilly Skirt',
            'stock' => '12',
            'price' => '350000',
            'picture' => random_int(1,$num_originals).'.jpg',
            'id_admin' => rand($min = 1, $max = 2),
            'id_category' => '2',
        ]);
        DB::table('goods')->insert([
            'goods_name' => 'MERYL TROUSERS',
            'stock' => '12',
            'price' => '335000',
            'picture' => random_int(1,$num_originals).'.jpg',
            'id_admin' => rand($min = 1, $max = 2),
            'id_category' => '2',
        ]);
        DB::table('goods')->insert([
            'goods_name' => 'Hedy Pants',
            'stock' => '12',
            'price' => '240000',
            'picture' => random_int(1,$num_originals).'.jpg',
            'id_admin' => rand($min = 1, $max = 2),
            'id_category' => '2',
        ]);
        DB::table('goods')->insert([
            'goods_name' => 'Kira Pants',
            'stock' => '12',
            'price' => '380000',
            'picture' => random_int(1,$num_originals).'.jpg',
            'id_admin' => rand($min = 1, $max = 2),
            'id_category' => '2',
        ]);
//+++++++++++------------------------------ Dress------------------------------------++++++++++//
        DB::table('goods')->insert([
            'goods_name' => 'Mace Dress',
            'stock' => '12',
            'price' => '349000',
            'picture' => random_int(1,$num_originals).'.jpg',
            'id_admin' => rand($min = 1, $max = 2),
            'id_category' => '3',
        ]);
        DB::table('goods')->insert([
            'goods_name' => 'Earth Dress',
            'stock' => '12',
            'price' => '350000',
            'picture' => random_int(1,$num_originals).'.jpg',
            'id_admin' => rand($min = 1, $max = 2),
            'id_category' => '3',
        ]);
        DB::table('goods')->insert([
            'goods_name' => 'Bergamout Dress',
            'stock' => '12',
            'price' => '380000',
            'picture' => random_int(1,$num_originals).'.jpg',
            'id_admin' => rand($min = 1, $max = 2),
            'id_category' => '3',
        ]);
        DB::table('goods')->insert([
            'goods_name' => 'Buttercup Dress',
            'stock' => '12',
            'price' => '380000',
            'picture' => random_int(1,$num_originals).'.jpg',
            'id_admin' => rand($min = 1, $max = 2),
            'id_category' => '3',
        ]);
        DB::table('goods')->insert([
            'goods_name' => 'DRU Dress',
            'stock' => '12',
            'price' => '380000',
            'picture' => random_int(1,$num_originals).'.jpg',
            'id_admin' => rand($min = 1, $max = 2),
            'id_category' => '1',
        ]);
        DB::table('goods')->insert([
            'goods_name' => 'DACIA Dress',
            'stock' => '12',
            'price' => '349000',
            'picture' => random_int(1,$num_originals).'.jpg',
            'id_admin' => rand($min = 1, $max = 2),
            'id_category' => '1',
        ]);
        DB::table('goods')->insert([
            'goods_name' => 'NEA Dress',
            'stock' => '12',
            'price' => '240000',
            'picture' => random_int(1,$num_originals).'.jpg',
            'id_admin' => rand($min = 1, $max = 2),
            'id_category' => '1',
        ]);
        DB::table('goods')->insert([
            'goods_name' => 'Diera Dress',
            'stock' => '12',
            'price' => '349000',
            'picture' => random_int(1,$num_originals).'.jpg',
            'id_admin' => rand($min = 1, $max = 2),
            'id_category' => '1',
        ]);
        DB::table('goods')->insert([
            'goods_name' => 'Chloe Dress',
            'stock' => '12',
            'price' => '350000',
            'picture' => random_int(1,$num_originals).'.jpg',
            'id_admin' => rand($min = 1, $max = 2),
            'id_category' => '3',
        ]);
        DB::table('goods')->insert([
            'goods_name' => 'Jenahara Dress',
            'stock' => '12',
            'price' => '335000',
            'picture' => random_int(1,$num_originals).'.jpg',
            'id_admin' => rand($min = 1, $max = 2),
            'id_category' => '3',
        ]);
        DB::table('goods')->insert([
            'goods_name' => 'Vida Dress',
            'stock' => '12',
            'price' => '240000',
            'picture' => random_int(1,$num_originals).'.jpg',
            'id_admin' => rand($min = 1, $max = 2),
            'id_category' => '3',
        ]);
        DB::table('goods')->insert([
            'goods_name' => 'Lawren Dress',
            'stock' => '12',
            'price' => '380000',
            'picture' => random_int(1,$num_originals).'.jpg',
            'id_admin' => rand($min = 1, $max = 2),
            'id_category' => '3',
        ]);

    }
}
// }
// $faker = Faker::create();
// foreach(range(0,10) as $i){
    // factory(Goods::class, 6)->create()->each(function ($p){
    //   $num_originals = 3;
    //   $original_files_folder = 'productImages/food';
    //         // randomly select an image
    // $pathToFile = $original_files_folder . random_int(1, $num_originals) . '.jpg';
    // // add it to the product through the media library
    // $p->addMedia($pathToFile)->preservingOriginal()->toMediaCollection('product', 'product');
    // });
