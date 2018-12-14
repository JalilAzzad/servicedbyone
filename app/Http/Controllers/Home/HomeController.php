<?php

namespace App\Http\Controllers\Home;

use Cookie;
use App\Models\City;
use App\Models\User;
use App\Models\CityArea;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Jenssegers\Agent\Agent;
use App\Http\Controllers\Controller;
use App\API\IPStack\GeoIP;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application homepage.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GeoIP $ip_geo)
    {
        $popularCategories = ServiceCategory::take(8)->get();
        $agent = new Agent();
        $geolocation_object = json_decode($ip_geo->getLocationByIP());
        session(["visitor.zip"=>$geolocation_object->zip]);

        $location = CityArea::where('zip', session('visitor.zip'))->with('city', 'city.state')->first();
        $popularServices = collect([]);
        if (!is_null($location))
        {
            $popularServices = $location->city->state
                ->services()
                ->withCount('requests')
                ->orderBy('requests_count', 'desc')
                ->take($agent->isMobile() ? 10 : 4)
                ->get();
        }
        if($popularServices->count() <= 1)
        {
            $popularServices = Service::withCount('requests')
                ->orderBy('requests_count', 'desc')
                ->take($agent->isMobile() ? 10 : 4)
                ->get();
            $location = null;
        }
        return view('home.home', [
            'is_homepage' => true,
            'states' => State::where('state', '!=', 'Hawaii')->get(),
            'location' => $location,
            'popularServices' => $popularServices,
            'popularCategories' => $popularCategories,
            'agent' => $agent
        ]);
    }

    /**
     * Show the application contact page.
     *
     * @return \Illuminate\Http\Response
     */
    public function contact()
    {
        return view('home.contact');
    }

    /**
     * Show the application about page.
     *
     * @return \Illuminate\Http\Response
     */
    public function about()
    {
        $seo_title =  "About Us | Serviced By ONE";
        return view('home.about', [
            "seo_title" => $seo_title
        ]);
    }

    /**
     * Show the application careers page.
     *
     * @return \Illuminate\Http\Response
     */
    public function careers()
    {
        $seo_title =  "Careers | Serviced By ONE";
        return view('home.careers', [
            "seo_title" => $seo_title
        ]);
    }

    /**
     * Show the application press page.
     *
     * @return \Illuminate\Http\Response
     */
    public function press()
    {
        $seo_title =  "Press | Serviced By ONE";
        return view('home.press', [
            "seo_title" => $seo_title
        ]);
    }

    /**
     * Set the cookie for referrer.
     *
     * @return \Illuminate\Http\Response
     */
    public function cookieReferrer($referrer_slug)
    {
        $referrer = User::where('slug',$referrer_slug)->get();

        if(sizeof($referrer) > 0)
            Cookie::queue('referrer', $referrer[0]->id, 10080);

        return redirect('/');
    }

}
