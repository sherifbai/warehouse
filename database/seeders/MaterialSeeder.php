<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $material = Material::query()->create([
            'name' => 'mato',
        ]);
        $material->save();

        $material = Material::query()->create([
            'name' => 'tugma'
        ]);
        $material->save();

        $material = Material::query()->create([
            'name' => 'ip'
        ]);
        $material->save();

        $material = Material::query()->create([
            'name' => 'zamok'
        ]);
        $material->save();
    }
}
