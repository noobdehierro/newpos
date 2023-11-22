<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
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
                'name' => 'Figou',
                'prefix' => 'FIG',
                'iccid_prefix' => '123456789876',
                'logo' => 'figou.png',
                'token' => 'MToyWnEySTFqV0JSOVhBWmpoYVZkSk9Rd2g4aEt0RWMxSFVUTUVyWGR3',
                'is_active' => true,
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
            [
                'name' => 'Lgbt',
                'prefix' => 'LGBT',
                'iccid_prefix' => '123456789876',
                'logo' => 'lgbt.png',
                'token' => 'MToyWnEySTFqV0JSOVhBWmpoYVZkSk9Rd2g4aEt0RWMxSFVUTUVyWGR3',
                'is_active' => true,
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
            [
                'name' => 'Bo',
                'prefix' => 'BO',
                'iccid_prefix' => '123456789876',
                'logo' => 'bo.png',
                'token' => 'MToyWnEySTFqV0JSOVhBWmpoYVZkSk9Rd2g4aEt0RWMxSFVUTUVyWGR3',
                'is_active' => true,
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ],
        ];

        foreach ($brands as $brand) {
            \App\Models\Brand::create($brand);
        }
    }
}
