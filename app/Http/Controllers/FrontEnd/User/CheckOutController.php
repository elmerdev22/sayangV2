<?php

namespace App\Http\Controllers\FrontEnd\User;

use Luigel\Paymongo\Facades\Paymongo;
use Illuminate\Http\Request;
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

    public function paymongo_pay(Request $request){
        if($request->success){
            $billing_details = $request->billing_details;

            if(isset($billing_details)){
                set_time_limit(0);

                $response = ['success' => false];
                
                DB::beginTransaction();
                try{
                    if(isset($billing_details['orders'])){
                        if(count($billing_details['orders']) > 0){
                            $checker = [];

                            foreach($billing_details['orders'] as $order){
                                $payment = PaymentUtility::pay_order($order['order_id'], $billing_details['paymongo']);
                                
                                if(!$payment){
                                    $checker[] = false;
                                }
                            }
                            
                            if(!in_array(false, $checker)){
                                $response['success'] = true;
                            }
                        }
                    }
                }catch(\Exception $e){
                    dd($e);
                    $response['success'] = false;
                }

                if($response['success']){
                    DB::commit();
                    Session::flash('checkout_payment', ['success' => true]);
                }else{
                    DB::rollback();
                    Session::flash('checkout_payment', ['success' => false]);
                }

                return redirect(route('front-end.user.my-purchase.list'))->send();
            }else{
                return [
                    'message' => 'Transaction failed.'
                ];
            }
        }else{
            return [
                'message' => 'Transaction failed.'
            ];
        }
    }

    public function pay(){
        try{
            // $source = Paymongo::source()->create([
            //     'type'     => 'grab_pay',
            //     'amount'   => 1000,
            //     'currency' => 'PHP',
            //     'redirect' => [
            //         'success' => route('front-end.user.my-account.index', ['success' => true]),
            //         'failed'  => route('front-end.user.my-account.index', ['success' => false])
            //     ]
            // ]);
            // $source = Paymongo::source()->find('src_TYLTAoepUwZfkUhMCJtEND87');
            // dd($source);
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
