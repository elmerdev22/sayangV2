<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class HelpCentreQuestion extends Model
{
    
    use Sluggable;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'question'
            ]
        ];
    }

    public function help_centre(){
        return $this->belongsTo('App\Model\HelpCentre', 'help_centre_id', 'id');
    }
    
    public function help_centre_answer(){
        return $this->hasMany('App\Model\HelpCentreAnswer', 'help_centre_answer_id', 'id');
    }
}
