<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Referral;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('role:'.User::USER);
        $this->middleware('verified');
    }

    /**
     * Show the application dashboard for user.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $requests = auth()->user()->requests()->with('invoice')->orderBy('created_at', 'desc')->get();
        return view('user.dashboard',['requests' => $requests]);
    }

    /**
     * Show the application referral page for user.
     *
     * @return \Illuminate\Http\Response
     */
    public function referral()
    {
       $referees = Referral::where('referrer_id',auth()->user()->id)->get();

       if(sizeof($referees) > 0)
       {
            foreach ($referees as $referee) {
                $referee->email = User::where('id',$referee->referee_id)->first()->email;
            }    
       }

       return view('user.referral',['referees' => $referees,'total' => auth()->user()->balance]);
    }
}
