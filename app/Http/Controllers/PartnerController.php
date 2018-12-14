<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    /**
     * Display partner.
     *
     * @return \Illuminate\Http\Response
     */

    public function showPartner($slug)
    {
        $partner = Partner::where('slug',$slug)->get();
        
        if(sizeof($partner))
            return view('partner.partner')->with('partner' , $partner[0]);
        
        return redirect('/partner');
    }

}
