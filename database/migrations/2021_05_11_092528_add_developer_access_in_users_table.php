<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Model\User;
use App\Model\UserAdmin;
use App\Model\UserAdminRole;

class AddDeveloperAccessInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
                
            DB::beginTransaction();
            try{
                $success = false;

                $user                    = new User();
                $user->name              = 'developer_elmer';
                $user->email             = 'developer@sayang.ph';
                $user->type              = 'admin';
                $user->verification_type = 'email';
                $user->verified_at       = date('Y-m-d H:i:s');
                $user->password          = Hash::make('adminadmin');
                $user->key_token         = Utility::generate_table_token('User');
                if($user->save()){
                    $admin             = new UserAdmin();
                    $admin->user_id    = $user->id;
                    $admin->account_no = date('ymd').rand(1,50);
                    $admin->first_name = 'Elmer';
                    $admin->last_name  = 'Developer';
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
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
