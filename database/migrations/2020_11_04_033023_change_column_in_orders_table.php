<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ChangeColumnInOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            /* 
                Status Step Arrangement:
                1          => Order Placed
                2          => Payment Confirmed
                3          => To Receive
                4          => Completed
                (optional) => Cancelled
            */
            DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM('cancelled', 'completed', 'order_placed', 'payment_confirmed', 'to_receive')");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
}
