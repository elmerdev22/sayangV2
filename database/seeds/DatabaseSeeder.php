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
        $this->call(RegionProvinceTableSeeder::class);
        $this->call(CityTableSeeder::class);
        $this->call(BankTableSeeder::class);
        $this->call(UserAdminRoleTypeTableSeeder::class);
        $this->call(UserTableSeeder::class);
    }
}
