<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\PermissionsAndRolesSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\CuisineSeeder;

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
        	UserSeeder::class,
        	CuisineSeeder::class,
        	PermissionsAndRolesSeeder::class,
        ]);
    }
}
