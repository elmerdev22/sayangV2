<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Model\User;
use App\Model\UserAdmin;
use App\Model\UserAdminRole;
use App\Helpers\Utility;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        try{
            $success = false;

            $user                    = new User();
            $user->name              = 'admin';
            $user->email             = 'admin@sayang-ph.com';
            $user->type              = 'admin';
            $user->verification_type = 'email';
            $user->verified_at       = date('Y-m-d H:i:s');
            $user->password          = Hash::make('adminadmin');
            $user->key_token         = Utility::generate_table_token('User');
            if($user->save()){
                $admin             = new UserAdmin();
                $admin->user_id    = $user->id;
                $admin->account_no = date('ymd').rand(1,50);
                $admin->first_name = 'Sayang';
                $admin->last_name  = 'Admin';
                $admin->key_token  = Utility::generate_table_token('UserAdmin');
                if($admin->save()){
                    $role                = new UserAdminRole();
                    $role->user_admin_id = $admin->id;
                    $role->role_type_id  = 1;
                    if($role->save()){
                        $success = true;
                    }
                }
            }
        }catch(\Exception $e){
            $success = false;
        }

        if($success){
            DB::commit();
        }else{
            DB::rollback();
        }
    }
}
