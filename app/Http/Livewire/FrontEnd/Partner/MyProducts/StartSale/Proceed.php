<?php

namespace App\Http\Livewire\FrontEnd\Partner\MyProducts\StartSale;

use Livewire\Component;
use App\Model\ProductPost;
use App\Model\Product;
use Carbon\Carbon;
use App\Model\Setting;
use Utility;
use DB;

class Proceed extends Component
{
    public $partner, $selected_products = [], $start_date, $end_date, $hours_error='', $min_hours, $max_hours;
    protected $listeners = [
        'proceed_to_start_sale' => 'initialize'
    ];

    public function mount(){
        $this->partner = Utility::auth_partner();
        $this->min_hours = Setting::where('settings_key', 'minimum_hours_in_auction')->first()->settings_value;
        $this->max_hours = Setting::where('settings_key', 'maximum_hours_in_auction')->first()->settings_value;
    }

    public function initialize($param){
        $this->selected_products = $param['data'];
        $this->emit('proceed_done', true);
    }

    public function product($product_id){
        return Product::find($product_id);
    }

    public function render(){
        $component = $this;
        return view('livewire.front-end.partner.my-products.start-sale.proceed', compact('component'));
    }

    public function set_date($type, $timestamp){
        $this->$type = date('Y-m-d H:00:00', strtotime($timestamp));
        // dd($type.' = '.$this->$type);
    }

    public function store(){
        $this->hours_error = '';

        $rules = [
            'selected_products' => 'required',
            'start_date'        => 'required|date',
            'end_date'          => 'required|date|after_or_equal:start_date'
        ];

        $this->validate($rules);
        $start = Carbon::parse($this->start_date);
        $end   = Carbon::parse($this->end_date);
        $hours = $end->diffInHours($start);
        if($this->min_hours > $hours){
            $this->hours_error = 'The minimum hours for posting is: '.$this->min_hours.' hrs.';
            return false;
        }else if($this->max_hours < $hours){
            $this->hours_error = 'The maximum hours for posting is: '.$this->max_hours.' hrs.';
            return false;
        }
        
        $response = ['success' => false, 'message' => ''];

        DB::beginTransaction();
        try{
            foreach($this->selected_products as $key => $row){
                $product_post                = new ProductPost();
                $product_post->product_id    = $row['product_id'];
                $product_post->buy_now_price = $row['buy_now_price'];
                $product_post->lowest_price  = $row['lowest_price'];
                $product_post->quantity      = $row['quantity'];
                $product_post->date_start    = $this->start_date;
                $product_post->date_end      = $this->end_date;
                $product_post->status        = 'active';
                $product_post->is_set        = true;
                $product_post->key_token     = Utility::generate_table_token('ProductPost');
                $product_post->save();
            }
            $response['success'] = true;
        }catch(\Exception $e){
            $response['success'] = false;
        }

        if($response['success']){
            DB::commit();
            $this->emit('alert_link', [
                'type'     => 'success',
                'title'    => 'Successfully Saved',
                'message'  => 'Products successfully added to active/upcoming sales.',
            ]);
        }else{
            DB::rollback();
            $this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Failed',
                'message' => 'An error occured while adding the product sales.'
            ]);
        }
    }
}
