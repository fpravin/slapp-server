<?php

use Illuminate\Database\Seeder;
// use CategoryTableSeeder;
// use UserTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CategoryTableSeeder::class,
            UserTableSeeder::class,
        ]);
    }
}
