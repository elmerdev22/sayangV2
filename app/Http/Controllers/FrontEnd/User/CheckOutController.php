<?php

namespace App\Http\Controllers\FrontEnd\User;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Luigel\Paymongo\Facades\Paymongo;
use App\Http\Controllers\Controller;
use App\Model\Cart;
use App\Model\ProductPost;
use App\Model\Order;
use App\Model\OrderItem;
use App\Model\OrderPayment;
use App\Model\OrderPaymentLog;
use App\Events\CheckOut;
use PaymentUtility;
use Utility;
use Session;
use DB;

class CheckOutController extends Controller
{

    public function index(){
        $cart = Utility::cart(Utility::auth_user_account()->id, true);

        if($cart['total_items'] <= 0){
            Session::flash('check_out_item_alert', true);
            return redirect(route('front-end.user.my-cart.index'))->send();
        }

        return view('front-end.user.check-out.index');
    }

    public function paymongo_pay_e_wallet(Request $request){
        $response = ['success' => false, 'message' => ''];

        if($request->success){
            $billing_details = $request->billing_details;
            $product_posts   = [];

            if(isset($billing_details)){
                set_time_limit(0);
                
                DB::beginTransaction();
                try{
                    if(isset($billing_details['orders'])){
                        if(count($billing_details['orders']) > 0){
                            if(isset($billing_details['orders'][0]['order_payment_log_id'])){
                                $order_payment_log_id = $billing_details['orders'][0]['order_payment_log_id'];
                                $payment_log          = OrderPaymentLog::find($order_payment_log_id);
                                if($payment_log){
                                    $payment_source    = $payment_log->method;
                                    $payment_source_id = $payment_log->method_id;
                                    
                                    if(!empty($payment_source_id)){
                                        $source = Paymongo::source()->find($payment_source_id);
                                        if($source){
                                            if($source->status === 'chargeable'){
                                                $checker = [];
                                                foreach($billing_details['orders'] as $order){
                                                    $pay_response = PaymentUtility::pay_order($order['order_id'], $billing_details['paymongo']);
                                                    if(!$pay_response['success']){
                                                        $checker[] = false;
                                                        $response['message'] = $pay_response['message'];
                                                        break;
                                                    }else{
                                                        $product_posts[] = $pay_response['product_posts'];
                                                    }
                                                }
                                                
                                                if(!in_array(false, $checker)){
                                                    $response['success'] = true;
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }catch(\Exception $e){
                    // dd($e);
                    $response['success'] = false;
                }

                if($response['success']){
                    try{
                        $order_numbers = '';

                        foreach($billing_details['orders'] as $order_row){
                            $order_numbers .= $order_row['order_no'].', ';
                        }
    
                        $order_numbers       = substr($order_numbers, 0, -2);
                        $payment_description = 'Billing No: '.$billing_details['billing_no'].', Order No.: '.$order_numbers.' from Source ID: '.$payment_source_id.' - method type ('.$source->type.').';
    
                        $payment = Paymongo::payment()->create([
                            // 'amount'      => $source->amount / 100,
                            'amount'      => $source->amount,
                            'currency'    => $source->currency,
                            'description' => $payment_description,
                            'source'      => [
                                'id'   => $source->id,
                                'type' => $source->type,
                            ]
                        ]);
    
                        foreach($billing_details['orders'] as $order){
                            $payment_log                      = OrderPaymentLog::find($order['order_payment_log_id']);
                            $payment_log->paymongo_payment_id = $payment->id;
                            $payment_log->save();
                        }
                    }catch(\Exception $e){
                        $payment = false;
                    }
                    
                    if($payment){
                        if(count($product_posts) > 0){
                            foreach($product_posts as $key => $product_post){
                                event(new CheckOut($product_post));
                            }
                        }

                        DB::commit();
                        Session::flash('checkout_payment', ['success' => true, 'message' => $response['message']]);
                    }else{
                        DB::rollback();
                        Session::flash('checkout_payment', ['success' => false, 'message' => $response['message']]);
                    }
                }else{
                    DB::rollback();
                    Session::flash('checkout_payment', ['success' => false, 'message' => $response['message']]);
                }
            }else{
                Session::flash('checkout_payment', ['success' => false, 'message' => $response['message']]);
            }
        }else{
            Session::flash('checkout_payment', ['success' => false, 'message' => $response['message']]);
        }

        return redirect(route('front-end.user.my-purchase.list'))->send();
    }

    public function paymongo_repay_order_e_wallet(Request $request){
        $response = ['success' => false, 'message' => 'An error occured.'];
        
        if($request->success){

            if($request->order_key_token){
                $order = Order::with(['billing', 'order_payment.order_payment_log'])
                    ->where('key_token', $request->order_key_token)
                    ->first();

                if($order){
                    if($order->status == 'order_placed'){
                        $can_repay = Utility::order_can_repay($order->id);
                        
                        if($can_repay){
                            
                            DB::beginTransaction();
                            try{
                                $product_post = [];
                                $method_id    = $order->order_payment->order_payment_log->method_id;

                                $source = Paymongo::source()->find($method_id);
                                
                                if($source){
                                    if($source->status === 'chargeable'){
                                        $paymongo = [
                                            'type'   => $source->source_type,
                                            'method' => 'e_wallet'
                                        ];

                                        $pay_response = PaymentUtility::pay_order($order->id, $paymongo);

                                        if(!$pay_response['success']){
                                            $checker[]           = false;
                                            $response['message'] = $pay_response['message'];
                                        }else{
                                            $product_post        = $pay_response['product_posts'];
                                            $response['success'] = true;
                                        }
                                    }
                                }
                            }catch(\Exception $e){
                                // dd($e);    
                            }

                            if($response['success']){
                                
                                $payment_description = 'Billing No: '.$order->billing->billing_no.', Order No.: '.$order->order_no.' from Source ID: '.$method_id.' - method type (source).';
            
                                $payment = Paymongo::payment()->create([
                                    // 'amount'      => $source->amount / 100,
                                    'amount'      => $source->amount,
                                    'currency'    => $source->currency,
                                    'description' => $payment_description,
                                    'source'      => [
                                        'id'   => $source->id,
                                        'type' => $source->type,
                                    ]
                                ]);

                                if($payment){
                                    $payment_log                      = OrderPaymentLog::find($order->order_payment->order_payment_log->id);
                                    $payment_log->paymongo_payment_id = $payment->id;
                                    $payment_log->save();
    
                                    DB::commit();
                                    if(!empty($product_post)){
                                        event(new CheckOut($product_post));
                                    }
                                }else{
                                    $response['success'] = false;
                                    DB::rollback();
                                }
                            }else{
                                DB::rollback();  
                            }
                        }
                    }
                }
            }
        }

        Session::flash('checkout_payment', ['success' => $response['success'], 'message' => $response['message']]);
        return redirect(route('front-end.user.my-purchase.list'))->send();
    }

    public function pay(){
        try{
            
            // $payment = Paymongo::payment()->find('pay_xhh12v2on9gxH1MU7GD6A4SL');
            // dd($payment);
            // $source = Paymongo::source()->find('src_LAN7xNZ8KwimADJTceBza6bG');
            // dd($source);
            // if($source->status === 'chargeable'){
            //     $payment = Paymongo::payment()->create([
            //         // 'amount'      => $source->amount / 100,
            //         'amount'      => $source->amount,
            //         'currency'    => $source->currency,
            //         'description' => $source->type.' - '.str_replace('_', ' ', $source->source_type).' test 2 from source id: '.$source->id,
            //         'source'      => [
            //             'id'   => $source->id,
            //             'type' => $source->type,
            //         ]
            //     ]);
            // }else{
            //     dd('NOT CHARGEABLE');
            // }
            // dd($payment);
            // return redirect($source->getRedirect()['checkout_url'])->send();

            // $paymentMethod = Paymongo::paymentMethod()->create([
            //     'type'      => 'card',
            //     'details'   => [
            //         'card_number' => '4343434343434345',
            //         'exp_month'   => 12,
            //         'exp_year'    => 25,
            //         'cvc'         => "123",
            //     ],
            //     'billing'       => [
            //         'address'   => [
            //             'line1'       => 'Somewhere there',
            //             'city'        => 'Cebu City',
            //             'state'       => 'Cebu',
            //             'country'     => 'PH',
            //             'postal_code' => '6000',
            //         ],
            //         'name'  => 'Rigel Kent Carbonel',
            //         'email' => 'rigel20.kent@gmail.com',
            //         'phone' => '0935454875545'
            //     ],
            // ]);

            $paymentMethod = Paymongo::paymentMethod()->create([
                'type' => 'card',
                'details' => [
                    'card_number' => str_replace('-', '', '4120-0000-0000-0007'),
                    'exp_month'   => 12,
                    'exp_year'    => 30,
                    'cvc'         => '000'
                ],
                'billing' => [
                    'name'  => 'John Doe',
                    'email' => 'testjohndoe@email.com',
                    'phone' => '09123456789'
                ],
            ]);
            
            $newPaymentIntent = Paymongo::paymentIntent()->create([
                'amount'                 => 100,
                'payment_method_allowed' => [
                    'card'
                ],
                'payment_method_options' => [
                    'card' => [
                        'request_three_d_secure' => 'automatic'
                    ]
                ],
                'description'          => 'This is a test payment intent',
                'statement_descriptor' => 'LUIGEL STORE',
                'currency'             => "PHP"
            ]);

            $response = ['success' => false, 'message' => 'An error occured on payment with your card while processing the transaction'];

            try{
                $paymentIntent = Paymongo::paymentIntent()->find($newPaymentIntent->id);
                if($paymentIntent->status === 'awaiting_payment_method'){
                    
                    $paymentIntentAttach = $paymentIntent->attach($paymentMethod->id);
                    // 'return_url'     => 'http://127.0.0.1:8003/'
                    
                    if($paymentIntentAttach->status === 'awaiting_next_action'){
                        // $paymentIntentAttach->next_action['redirect']['return_url'] = 'https://sayang-ph.com';
                        // https://test-sources.paymongo.com/sources?id=src_iatsdaXmsKLHQhpcTTm9fWFH
                        $next_action = $paymentIntentAttach->next_action;
                        dd($paymentIntentAttach);
                        return redirect($next_action['redirect']['url'])->send();
                    }else if($paymentIntentAttach->status === 'succeeded'){
                        dd($paymentIntentAttach);
                    }
                }
            }catch(\Exception $e){
                dd($e);
                $exception = json_decode($e->getMessage());
                $message   = $exception->errors[0];
                if($message->code == 'resource_failed_state'){
                    $response['message'] = $message->detail;
                }
            }
            dd($response);
            // $payment = Paymongo::payment()
            //         ->create([
            //             'amount'               => 100.00,
            //             'currency'             => 'PHP',
            //             'description'          => 'Testing payment',
            //             'statement_descriptor' => 'Test Paymongo',
            //             'source'               => [
            //                 'id' => $paymentMethod->id,
            //                 'type' => 'payment_intent'
            //             ]
            //         ]);
            // dd($payment);
        }catch(\Exception $e){
            dd($e);
        }
    }
}
