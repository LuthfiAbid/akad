<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin')->insert([
            'id_admin' => '1',
            'username' => 'Admin123',
            'password' => bcrypt('123Admin'),
            'admin_name' => 'Admin Steve',            
        ]);

        DB::table('admin')->insert([
            'id_admin' => '2',
            'username' => 'Admin321',
            'password' => bcrypt('321Admin'),
            'admin_name' => 'Admin Ronald',            
        ]);
    }
}
