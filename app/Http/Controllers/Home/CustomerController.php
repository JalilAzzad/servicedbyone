<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    /**
     * Show the application customer's howItWorks page.
     *
     * @return \Illuminate\Http\Response
     */
    public function howItWorks()
    {
        return view('home.customer.how-it-works');
    }


    /**
     * Show the application customer's near me page.
     *
     * @return \Illuminate\Http\Response
     */
    public function nearMe()
    {
        $seo_title =  "Services Near Me | Serviced By ONE";
        return view('home.customer.near-me', [
            'seo_title' => $seo_title
        ]);
    }

    /**
     * Show the application customer's prices page.
     *
     * @return \Illuminate\Http\Response
     */
    public function prices()
    {
        $seo_title =  "Cost Estimates | Serviced By ONE";
        return view('home.customer.prices', [
            'seo_title' => $seo_title
        ]);
    }

}
