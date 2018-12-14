<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WorkerController extends Controller
{
    /**
     * Show the application worker's howItWorks page.
     *
     * @return \Illuminate\Http\Response
     */
    public function howItWorks()
    {
        return view('home.worker.how-it-works');
    }

    /**
     * Show the application worker's safety page.
     *
     * @return \Illuminate\Http\Response
     */
    public function safety()
    {
        return view('home.worker.safety');
    }
}
