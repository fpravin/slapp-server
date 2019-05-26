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
            'name' => 'Kewin SA',
            'email' => 'test1@gmail.com',
            'password' => '$2y$10$qT0fwgz5EzC5uB8ErvAVAuz5oZ56Olj6Yu250cEZxAL1aUROjlKyW',
            'f_code' => 'F00'
        ]);
        DB::table('users')->insert([
            'name' => 'Kewin PA',
            'email' => 'test2@gmail.com',
            'password' => '$2y$10$qT0fwgz5EzC5uB8ErvAVAuz5oZ56Olj6Yu250cEZxAL1aUROjlKyW',
            'f_code' => 'F100'
        ]);
        DB::table('users')->insert([
            'name' => 'Kewin AU',
            'email' => 'test3@gmail.com',
            'password' => '$2y$10$qT0fwgz5EzC5uB8ErvAVAuz5oZ56Olj6Yu250cEZxAL1aUROjlKyW',
            'f_code' => 'F200'
        ]);
    }
}
