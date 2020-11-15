<?php

namespace App\Http\Livewire\BackEnd\Setting\Ratings;

use Livewire\Component;
use App\Model\Rating;
class Index extends Component
{
    public $star, $rating;
    public function render()
    {
        $data = Rating::orderBy('rating', 'asc')->get();
        return view('livewire.back-end.setting.ratings.index', compact('data'));
    }

    public function add($star){
        $this->star = $star;
    }
    public function delete($id){
        Rating::find($id)->delete();
    }

    public function save(){
        
        $this->validate([
            'rating' => 'required',
        ]);

        $rating         = new Rating();
        $rating->star   = $this->star;
        $rating->rating = $this->rating;
        if($rating->save()){
            $this->rating = '';
            $this->emit('alert', [
                'type'              => 'success',
                'title'             => 'Successfully Added',
                'message'           => 'Rating Successfully Added!. <br><br>',
                'timer'             => 1000,
                'showConfirmButton' => false
            ]);
        }
    }
}
