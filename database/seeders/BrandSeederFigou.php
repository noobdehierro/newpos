<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BrandSeederFigou extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dt = Carbon::now();
        $dateNow = $dt->toDateTimeString();

        $brands = [
            [
                'parent_id' => null,
                'name' => 'Figou',
                'description' => 'Marca principal de IGOU',
                'logo' => 'LtU9KxxtmyTx9SF53rcljrEuhEZ5aqjzHeqg9McL.png',
                'iccid_prefix' => '89521400617',
                'is_primary' => true,
                'is_active' => true
            ]
        ];

        foreach ($brands as $brand) {
            DB::table('brands')->insert([
                'parent_id' => $brand['parent_id'],
                'name' => $brand['name'],
                'description' => $brand['description'],
                'iccid_prefix' => $brand['iccid_prefix'],
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
                'is_primary' => $brand['is_primary'],
                'is_active' => $brand['is_active']
            ]);
        }
    }
}
