<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Model\OrderItem;

class AddPriceColumnInOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('order_items', function (Blueprint $table) {
            $table->decimal('price', 11,2)->nullable()->default(0)->after('quantity');
        });

        $order_items = OrderItem::with(['product_post'])->get();

        foreach($order_items as $item){
            $item->price = $item->product_post->buy_now_price;
            $item->save();
        }
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_items', function (Blueprint $table) {
            //
        });
    }
}
