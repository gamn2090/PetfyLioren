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
        $this->call(CiudadSeeder::class);
        $this->call(ComunaSeeder::class);
        $this->call(CompaniaSeeder::class);
        $this->call(UserSeeder::class);
    }
}
