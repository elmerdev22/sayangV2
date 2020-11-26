<?php

namespace App\Http\Controllers\FrontEnd\User;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Luigel\Paymongo\Facades\Paymongo;
use App\Http\Controllers\Controller;
use App\Model\Cart;
use App\Model\ProductPost;
use App\Model\Order;
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
        if($request->success){
            $billing_details = $request->billing_details;
            $product_posts   = [];

            if(isset($billing_details)){
                set_time_limit(0);

                $response = ['success' => false, 'message' => ''];
                
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
                    dd($e);
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

    public function pay(){
        try{
            // $billing_details['paymongo']['payment_id'] = 123;
            // dd($billing_details);
            // $source = Paymongo::source()->create([
            //     'type'     => 'grab_pay',
            //     'amount'   => 1000,
            //     'currency' => 'PHP',
            //     'redirect' => [
            //         'success' => route('front-end.user.my-account.index', ['success' => true]),
            //         'failed'  => route('front-end.user.my-account.index', ['success' => false])
            //     ]
            // ]);
            // dd($source);
            // return redirect($source->getRedirect()['checkout_url'])->send();
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

            // $paymentIntent = Paymongo::paymentIntent()->create([
            //     'amount'                 => 100,
            //     'payment_method_allowed' => [
            //         'card'
            //     ],
            //     'payment_method_options' => [
            //         'card' => [
            //             'request_three_d_secure' => 'automatic'
            //         ]
            //     ],
            //     'description' => 'This is a test payment intent',
            //     'statement_descriptor' => 'LUIGEL STORE',
            //     'currency' => "PHP",
            // ]);
            // dd($paymentIntent);

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
            // dd($paymentMethod);

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
