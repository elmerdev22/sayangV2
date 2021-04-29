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
        $this->call(PhilippineRegionTableSeeder::class);
        $this->call(PhilippineProvinceTableSeeder::class);
        $this->call(PhilippineCityTableSeeder::class);
        $this->call(PhilippineBarangayTableSeeder::class);
        $this->call(BankTableSeeder::class);
        $this->call(UserAdminRoleTypeTableSeeder::class);
        $this->call(SettingTableSeeder::class);
        $this->call(RatingTableSeeder::class);
        $this->call(NotificationTableSeeder::class);
        $this->call(EmailNotificationSettingTableSeeder::class);
        $this->call(WebNotificationSettingTableSeeder::class);
        $this->call(DescriptionSettingTableSeeder::class);
        $this->call(ImageSettingTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(UserTableSeeder::class);
    }
}
