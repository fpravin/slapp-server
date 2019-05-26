<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('categories')->insert([
            'category' => 'Restaurent',
        ]);
        DB::table('categories')->insert([
            'category' => 'Pub',
        ]);
        DB::table('categories')->insert([
            'category' => 'Shopping',
        ]);
        DB::table('categories')->insert([
            'category' => 'Coffee Shop',
        ]);
    }
}
