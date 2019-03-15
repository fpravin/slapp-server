<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' => 'Kewin',
            'email' => 'kewin@gmail.com',
            'password' => '$2y$10$qT0fwgz5EzC5uB8ErvAVAuz5oZ56Olj6Yu250cEZxAL1aUROjlKyW'
        ]);
    }
}
