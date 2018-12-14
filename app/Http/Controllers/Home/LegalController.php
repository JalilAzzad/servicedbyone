<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LegalController extends Controller
{
    /**
     * Show the application legal's privacy policy
     */
    public function privacyPolicy()
    {
        return view('home.legal.privacy-policy');
    }

    /**
     * Show the application legal's terms of use
     */
    public function termsOfUse()
    {
        return view('home.legal.terms-of-use');
    }
}
