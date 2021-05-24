<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
            DirectorsTableSeeder::class,
            DepartmentsTableSeeder::class,
            WorkersTableSeeder::class,
            PhonesTableSeeder::class,
        ]);
    }
}
