<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class HelpCentreAnswer extends Model
{
    
    public function help_centre_question(){
        return $this->belongsTo('App\Model\HelpCentreQuestion', 'help_centre_question_id', 'id');
    }
}
