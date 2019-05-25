<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'id_category' => '1',
            'category_name' => 'T Shirt',
        ]);

        DB::table('categories')->insert([
            'id_category' => '2',
            'category_name' => 'Pants',
        ]);

        DB::table('categories')->insert([
            'id_category' => '3',
            'category_name' => 'Dress',
        ]);
    }
}
