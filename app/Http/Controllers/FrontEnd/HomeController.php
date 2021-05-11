<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Bid;
use App\Model\ImageSetting;
use QueryUtility;
use Utility;
class HomeController extends Controller
{
    public function index(){
        
        $advocacy_section_card    = ImageSetting::orderBy('arrangement','asc')->where('settings_group','advocacy_section')->get();
        $advocacy_section_2       = Utility::image_settings('title_1','advocacy_section_2');
        $become_a_partner_section = Utility::image_settings('become_a_partner','become_a_partner_section');
        $elements                 = Utility::rescued_elements_computation('all');
        $decimal_places           = Utility::settings('elements_round_off');
        $featured_partners        = self::featured_partners();

        $data = [
            'element_trees'            => number_format($elements['trees'], $decimal_places),
            'element_water'            => number_format($elements['water'], $decimal_places),
            'element_energy'           => number_format($elements['energy'], $decimal_places),
            'advocacy_section_card'    => $advocacy_section_card,
            'advocacy_section_2'       => $advocacy_section_2,
            'become_a_partner_section' => $become_a_partner_section,
            'featured_partners'        => $featured_partners,
        ];

        return view('front-end.home.index', compact('data'));
    }

    public function featured_partners(){

		$filter = [];
		$filter['select'] = [
			'partners.*', 
            'user_accounts.key_token as user_key_token'
		];
		$filter['where']['users.type']            = 'partner';
		$filter['where']['partners.is_activated'] = 1;
		$filter['where']['partners.is_featured']  = 1;

		return QueryUtility::partners($filter)->limit(4)->get();
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
