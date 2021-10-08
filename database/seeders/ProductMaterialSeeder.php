<?php

namespace Database\Seeders;

use App\Models\ProductMaterial;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Koylak
        ProductMaterial::query()->create([
            'product_id' => 1,
            'material_id' => 1,
            'quantity' => 0.8
        ]);

        ProductMaterial::query()->create([
            'product_id' => 1,
            'material_id' => 2,
            'quantity' => 5
        ]);

        ProductMaterial::query()->create([
            'product_id' => 1,
            'material_id' => 3,
            'quantity' => 10
        ]);

        // Shim

        ProductMaterial::query()->create([
            'product_id' => 2,
            'material_id' => 1,
            'quantity' => 1.4
        ]);

        ProductMaterial::query()->create([
            'product_id' => 2,
            'material_id' => 3,
            'quantity' => 15
        ]);

        ProductMaterial::query()->create([
            'product_id' => 2,
            'material_id' => 4,
            'quantity' => 1
        ]);
    }
}
