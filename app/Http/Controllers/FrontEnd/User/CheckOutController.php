<?php

namespace App\Http\Controllers\FrontEnd\User;

use Luigel\Paymongo\Facades\Paymongo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Cart;
use Utility;
use Session;

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

    public function pay(){
        try{
            $source = Paymongo::source()->create([
                'type'     => 'gcash',
                'amount'   => '100.00',
                'currency' => 'PHP',
                'redirect' => [
                    'success' => route('front-end.user.my-account.index', ['success' => true]),
                    'failed'  => route('front-end.user.my-account.index', ['success' => false])
                ],
                // 'billing' => [
                //     'address' => 'Cabanatuan City, Nueva Ecija',
                //     'name'    => 'Christian De Leon',
                //     'email'   => 'cmdl.deleon02@gmail.com',
                // ]
            ]);
            // dd($source);
            return redirect($source->getRedirect()['checkout_url'])->send();

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
            //                 'type' => 'source'
            //             ]
            //         ]);
            // dd($payment);
        }catch(\Exception $e){
            dd($e);
        }
    }
}
