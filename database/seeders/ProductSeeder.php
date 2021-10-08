<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = Product::query()->create([
            'name' => 'Koylak',
            'code' => 'K'
        ]);

        $product->save();

        $product = Product::query()->create([
            'name' => 'Shim',
            'code' => 'S'
        ]);

        $product->save();
    }
}
