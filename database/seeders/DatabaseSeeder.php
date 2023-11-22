<?php

namespace Database\Seeders;

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
        $this->call(RoleSeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(UserSeeder::class);
        // $this->call(OfferingSeederLGBT::class);
        $this->call(ConfigurationSeeder::class);
        $this->call(MailSeeder::class);
        // $this->call(EquivalencySeeder::class);
    }
}
