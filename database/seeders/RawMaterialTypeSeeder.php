<?php

namespace Database\Seeders;

use App\Models\RawMaterialType;
use Illuminate\Database\Seeder;

class RawMaterialTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*Solid Additive*/
        RawMaterialType::create([
            'name' => 'Solid Additive',
            'description' => 'Solid additives for production',
            'creator_id' => 1,
        ]);
        /*Liquid Additive*/
        RawMaterialType::create([
            'name' => 'Liquid Additive',
            'description' => 'Liquid additives for production',
            'creator_id' => 1,
        ]);
    }
}
