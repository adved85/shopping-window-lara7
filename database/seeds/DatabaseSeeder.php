<?php

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
        $this->call(CalculationTypeSeeder::class);
        $this->call(UserSeeder::class);

        $this->call(ProductTypeSeeder::class);
        $this->call(ProductSeeder::class);
    }
}
