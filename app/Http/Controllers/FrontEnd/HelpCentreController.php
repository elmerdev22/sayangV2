<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class HelpCentreController extends Controller
{
    public function index(){
        return view('front-end.help-centre.index');
    }

    public function ask(Request $request){

        $question = $request->question;

		$select = [
            'help_centres.id as topic_id',
            'help_centres.topic',
            'help_centre_questions.id as question_id',
            'help_centre_questions.question',
            'help_centre_answers.answer',
        ];

        $results = DB::table('help_centres')
                 ->select($select)
                 ->leftJoin('help_centre_questions', 'help_centre_questions.help_centre_id', '=', 'help_centres.id')
                 ->leftJoin('help_centre_answers', 'help_centre_answers.help_centre_question_id', '=', 'help_centre_questions.id')
                 ->where('help_centre_questions.question', 'like', '%'.$question.'%')
                 ->orWhere('help_centre_answers.answer', 'like', '%'.$question.'%')
                 ->orWhere('help_centres.topic', 'like', '%'.$question.'%')
                 ->get();

    	return view('front-end.help-centre.ask', compact('question','results'));
    }
}
