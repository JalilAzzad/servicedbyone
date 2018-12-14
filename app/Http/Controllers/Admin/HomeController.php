<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Seo;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:'.User::ADMIN);
    }

    /**
     * Show the application dashboard for Admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {

        $baseUrl=url('/');
        $currentUrl=url()->current();
        $currentUrl=str_replace($baseUrl,"",$currentUrl); 
        $seo = Seo::where('url', '=', 'https://servicedbyone.com'.$currentUrl)->first();
        return view( 'admin.dashboard',['seo'=>$seo] );
    }

}
