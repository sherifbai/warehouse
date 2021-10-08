<?php

namespace Database\Seeders;

use App\Models\Material;
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
            MaterialSeeder::class,
            ProductSeeder::class,
            ProductMaterialSeeder::class,
            WarehouseSeeder::class
        ]);
    }
}
