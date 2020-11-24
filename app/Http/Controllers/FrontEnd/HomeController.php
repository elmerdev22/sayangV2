<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Bid;
use Utility;
class HomeController extends Controller
{
    public function index(){
        // $bids = Bid::with(['user_account.user','product_post.product.partner.user_account.user'])
        //         // ->where('product_post_id', $product_post->id)
        //         ->orderBy('bid', 'desc')
        //         ->get();
        // foreach($bids as $bid){
        //     dd($bid->product_post->product->partner->user_account->user->email);
        // }
                
        return view('front-end.home.index');
    }

    public function all_most_popular(){
        return view('front-end.home.all-most-popular.index');
    }

    public function all_recently_added(){
        return view('front-end.home.all-recently-added.index');
    }

    public function all_ending_soon(){
        return view('front-end.home.all-ending-soon.index');
    }
}
