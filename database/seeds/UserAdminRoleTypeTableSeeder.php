<?php

use Illuminate\Database\Seeder;
use App\Model\UserAdminRoleType;
use App\Helpers\Utility;

class UserAdminRoleTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type            = new UserAdminRoleType();
        $type->name      = 'Super Admin';
        $type->slug      = Utility::generate_table_slug('UserAdminRoleType', 'Super Admin');
        $type->key_token = Utility::generate_table_token('UserAdminRoleType');
        $type->save();
    }
}
