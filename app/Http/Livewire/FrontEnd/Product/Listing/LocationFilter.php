<?php

namespace App\Http\Livewire\FrontEnd\Product\Listing;

use Livewire\Component;
use App\Model\PhilippineRegion;
use App\Model\PhilippineCity;
use App\Model\PhilippineProvince;

class LocationFilter extends Component
{
    protected $listeners = [
        'clear_filter'    => 'clear_filter'
    ];

    public $region, $province, $city, $collapse;

    public function mount($collapse){
        $this->collapse = $collapse;
    }

    public function clear_filter(){
        $this->reset();
    }

    public function render(){
        $regions    = $this->regions();
        $provinces  = $this->provinces($this->region);
        $cities     = $this->cities($this->province);

        $this->data();
        return view('livewire.front-end.product.listing.location-filter', compact('regions', 'provinces', 'cities'));;
    }

    public function data(){
        $locations = [
            'region'   => $this->region,
            'province' => $this->province,
            'city'     => $this->city,
        ];

        $this->emit('filter_locations', $locations);
    }

    public function cities($province_id){
        if($province_id){
            return PhilippineCity::where('province_id', $province_id)->orderBy('name', 'asc')->get();
        }else{
            return [];
        }
    }

    public function provinces($region_id){
        if($region_id){
            return PhilippineProvince::where('region_id', $region_id)->orderBy('name', 'asc')->get();
        }else{
            return [];
        }
    }

    public function regions(){
        return PhilippineRegion::orderBy('name', 'asc')->get();
    }
}
