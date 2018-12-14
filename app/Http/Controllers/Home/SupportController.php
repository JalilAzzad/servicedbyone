<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupportController extends Controller
{
    /**
     * Show the application support guides page.
     *
     * @return \Illuminate\Http\Response
     */
    public function guides()
    {
        $seo_title =  "Frequently Asked Questions | Serviced By ONE";
        return view('home.support.guides', [
            'seo_title' => $seo_title
        ]);
    }

    /**
     * Show the application support how it works page
     */
    public function howItWorks()
    {
        $seo_title =  "How It Works | Serviced By ONE";
        return view('home.support.how-it-works', [
            'seo_title' => $seo_title
        ]);
    }


    /**
     * Show the application support safety and insurance page
     */
    public function safetyAndInsurance()
    {
        $seo_title =  "Safety and Insurance | Serviced By ONE";
        return view('home.support.safety-and-insurance', [
            'seo_title' => $seo_title
        ]);
    }

    /**
     * Show the application support testimonials and reviews page
     */
    public function testimonialsAndReviews()
    {
        $seo_title =  "Testimonials | Serviced By ONE";
        return view('home.support.testimonials-and-reviews', [
            'seo_title' => $seo_title
        ]);
    }



}
