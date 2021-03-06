<?php
namespace App\Helpers;

use Luigel\Paymongo\Facades\Paymongo;
use App\Model\Bid;
use App\Model\Bank;
use App\Model\Billing;
use App\Model\Cart;
use App\Model\Product;
use App\Model\ProductPost;
use App\Model\Order;
use App\Model\OrderBid;
use App\Model\OrderItem;
use App\Model\OrderPayment;
use App\Model\OrderPaymentLog;
use App\Events\CheckOut;
use Session;
use Utility;
use DB;

class PaymentUtility{
    
    public static function active_payments(){
        $response = [];
        
        $data = Bank::where('is_active', true)->orderBy('name', 'asc')->get();
        
        foreach($data as $row){
            $response[] = $row->id;
        }

        return $response;
    }

    public static function paymongo_commission($paymongo_payment_id, $payment_type){
        $response = [];

        if($payment_type == 'e_wallet'){
            $payment     = Paymongo::payment()->find($paymongo_payment_id);
            $fee         = $payment->fee / 100;
            $net_amount  = $payment->amount - $fee;
            $total       = $payment->amount;
            $foreign_fee = 0.00;
        }else if($payment_type == 'card'){
            $paymentIntent   = Paymongo::paymentIntent()->find($paymongo_payment_id);
            $payment_details = $paymentIntent->payments;
            $attribute       = $payment_details[0]['attributes'];
            $fee             = $attribute['fee'] / 100;
            $foreign_fee     = $attribute['foreign_fee'] / 100;
            $net_amount      = $attribute['amount'] - ($fee + $foreign_fee);
            $total           = $attribute['amount'];
        }

        $response = [
            'fee'         => $fee,
            'foreign_fee' => $foreign_fee,
            'net_amount'  => $net_amount,
            'total'       => $total
        ];


        return $response;
    }

    public static function commission_percentage(){
        return 6; //Default is 6% (Sayang commission percentage per order transaction)
    }

    public static function paymongo_minimum(){
        return 100.00;
    }

    public static function billing_country(){
        return 'PH'; //default is PH as ISO Code of Philippines
    }

    public static function currency(){
        return 'PHP'; //default is PHP (Peso)
    }

    public static function active_e_wallet($default=false){
        $response = [
            [
                'key'        => 'grab_pay',
                'name'       => 'Grab Pay',
                'minimum'    => self::paymongo_minimum(),
                'maximum'    => 999999,
                'is_default' => false
            ],
            [
                'key'        => 'gcash',
                'name'       => 'GCash',
                'minimum'    => self::paymongo_minimum(),
                'maximum'    => 999999,
                'is_default' => true
            ] 
        ];

        if($default){
            return $response[1];
        }else{
            return $response;
        }
    }

    public static function e_wallet($key, $type=null){

        $e_wallets = self::active_e_wallet();
        
        foreach($e_wallets as $row){
            if($row['key'] == $key){
                if($type){
                    return $row[$type];
                }else{
                    return $row;
                }
            }
        }

        return [];
    }

    public static function pay_order($order_id, array $paymongo=[], $is_cash_on_pickup=false){
        $response      = ['success' => false, 'message' => ''];
        $product_posts = [];

        try{

            /* <><><><><><><><><><><><><><>><><><><><><><><><><><><><><> */
            $order = Order::find($order_id);
                
            if($order){
                $order_total = Utility::order_total($order_id);
                $order_items = OrderItem::where('order_id', $order->id)->get();

                foreach($order_items as $order_item_row){
                    $product_post = ProductPost::find($order_item_row->product_post_id);
                    
                    if($product_post->quantity >= $order_item_row->quantity){
                        $remaining_quantity     = abs($product_post->quantity - $order_item_row->quantity);
                        $product_post->quantity = $remaining_quantity;
                        
                        if($product_post->save()){
                            if($remaining_quantity <= 0){
                                $bids = Bid::where('product_post_id', $product_post->id)->get();
                                foreach($bids as $bid){
                                    $bid->status = 'sold_out';
                                    if($bid->save()){
                                        /* Notify bidders that the item was sold out. */
                                    }
                                }
            
                                /* 
                                    Notify the users in carts table where the product_post_id = $product_post->id 
                                    that the product was sold out.
                                */
            
                                /* Notify the partner owner of this product post that his/her item was sold out */
                            }

                            $cart_update_quantity = Cart::where('product_post_id', $order_item_row->product_post_id)
                                ->get();
        
                            foreach($cart_update_quantity as $cart_update_quantity_row){
                                if($remaining_quantity == 0){
                                    $cart_update_quantity_row->quantity = 0;
                                }else{
                                    if($remaining_quantity <= $cart_update_quantity_row->quantity){
                                        $cart_update_quantity_row->quantity = $remaining_quantity;
                                    }
                                }
        
                                $cart_update_quantity_row->save();
                            }
        
                            $product_posts[] = [
                                'product_post_id'        => $order_item_row->product_post_id,
                                'product_post_key_token' => $product_post->key_token
                            ];
                        }
                    }else{
                        $response['message'] = 'One of the item currenntly is not available while processing the transaction.';
                        throw new \Exception('Uncaught Exeption');
                    }
                }

                $order_payment = OrderPayment::where('order_id', $order_id)->first();

                if($order_payment){
                    if(!empty($paymongo)){
                        //If E-wallet
                        $bank                                   = Bank::where('key_name', $paymongo['type'])->first();
                        $order_payment->payment_method          = $paymongo['method'];
                        $order_payment->bank_id                 = $bank->id;
                        $order_payment->card_holder             = null;
                        $order_payment->card_no                 = null;
                        $order_payment->card_expiration_date    = null;
                        $order_payment->card_verification_value = null;
                    }

                    if(!$is_cash_on_pickup){
                        $order_payment->status    = 'paid';
                        $order_payment->date_paid = date('Y-m-d H:i:s');

                        $order_bid = OrderBid::where('order_id', $order->id)->first();
                        if($order_bid){
                            $win_bid                 = Bid::find($order_bid->bid_id);
                            $win_bid->winning_status = 'paid';
                            $win_bid->save();
                        }
                    }

                    if($order_payment->save()){
                        // $order->status                 = 'payment_confirmed';
                        $order->status                 = 'to_receive';
                        $order->date_received          = date('Y-m-d H:i:s');
                        $order->date_payment_confirmed = date('Y-m-d H:i:s');

                        if($order->save()){
                            $response['success'] = true;
                        }
                    }
                }else{
                    throw new \Exception('Uncaught Exeption');
                }
            }
            /* <><><><><><><><><><><><><><>><><><><><><><><><><><><><><> */
        }catch(\Exception $e){
            // dd($e);
            $response['success'] = false;
        }

        $response['product_posts'] = $product_posts;
        return $response;
    }

    public static function allowed_method(){
        return ['e_wallet', 'card', 'cash_on_pickup'];
    }

}