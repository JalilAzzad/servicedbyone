<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\StoreServiceRequest;
use App\Http\Requests\Admin\UpdateServiceRequest;
use App\Models\City;
use App\Models\CityArea;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceQuestion;
use App\Models\State;
use App\Models\User;
use App\Models\Seo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::with('categories')->paginate();


        $baseUrl=url('/');
        $currentUrl=url()->current();
        $currentUrl=str_replace($baseUrl,"",$currentUrl); 
        $seo = Seo::where('url', '=', 'https://servicedbyone.com'.$currentUrl)->first();
        return view('admin.services.index', ['services' => $services,'seo' =>$seo]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.services.create', []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceRequest $request)
    {
        $validated = $request->validated();
        $service = Service::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            //'location_type' => $validated['location_type']
        ]);
        $this->handleSlug($service);
        $this->handleLocations($service, $validated['locations']);
        $service->categories()->sync($validated['categories']);
        $service->questions()->sync($validated['questions']);
        $path = isset($validated['featured_image']) ? $validated['featured_image']->store('public/services/'. $service->id) : null;
        $service->update(['featured_image' => $path]);
        
        $service->update(['resized_featured_image' => $this->resizedImage($path)]);
        return redirect('/admin/services')->with('status', 'Service is created successfully!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {

        $baseUrl=url('/');
        $currentUrl=url()->current();
        $currentUrl=str_replace($baseUrl,"",$currentUrl); 
        $seo = Seo::where('url', '=', 'https://servicedbyone.com'.$currentUrl)->first();
        return view('admin.services.show', ['service' => $service,'seo'=>$seo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {

        $baseUrl=url('/');
        $currentUrl=url()->current();
        $currentUrl=str_replace($baseUrl,"",$currentUrl); 
        $seo = Seo::where('url', '=', 'https://servicedbyone.com'.$currentUrl)->first();
        return view('admin.services.edit', ['service' => $service,'seo'=>$seo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {
        $validated = $request->validated();
        $service->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
//            'location_type' => $validated['location_type']
        ]);
        $this->handleSlug($service);
        $this->handleLocations($service, $validated['locations']);
        $service->categories()->sync($validated['categories']);
        $service->questions()->sync($validated['questions']);
        if(isset($validated['featured_image']))
        {
            if(!is_null($service->featured_image))
                Storage::delete($service->featured_image);
            $path = $validated['featured_image']->store('public/services/' . $service->id);
            $service->update(['featured_image' => $path]);
            
            $service->update(['resized_featured_image' => $this->resizedImage($path)]);
        }
        return redirect('/admin/services')->with('status', 'Service is updated successfully!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect('/admin/services')->with('status', 'Service is deleted successfully!!!');
    }

    public function categories(Request $request)
    {
        if($request->input('q', false))
        {
            $q = explode('|', $request->input('q'));
            $categories = ServiceCategory::where('name', 'like', '%'.$request->input('q').'%')->paginate();
        }
        else
            $categories = ServiceCategory::paginate();

        return $categories;
    }

    public function states(Request $request)
    {
        if($request->input('q', false))
        {
            $q = explode('|', $request->input('q'));
            if(empty($q[1]))
                $locations = State::where('state', 'like', '%' . $q[0] . '%')->paginate();
            else
                $locations = State::where('state', 'like', '%' . $q[0] . '%')->where('state_code', strtoupper($q[1]))->paginate();
        }
        else
            $locations = State::paginate();

        return $locations;
    }

    public function cities(Request $request)
    {
        if($request->input('q', false))
        {
            $q = explode('|', $request->input('q'));
            if(empty($q[1]))
                $locations = City::where('city', 'like', '%' . $q[0] . '%')->paginate();
            else
                $locations = City::where('city', 'like', '%' . $q[0] . '%')->where('state_code', strtoupper($q[1]))->paginate();
        }
        else
            $locations = City::paginate();

        return $locations;
    }

    public function areas(Request $request)
    {
        if($request->input('q', false))
        {
            $q = $request->input('q');
            $locations = CityArea::where('city', 'like', '%' . $q . '%')
                ->orWhere('zip', 'like', '%' . $q . '%')->paginate();
        }
        else
            $locations = CityArea::paginate();

        return $locations;
    }


    public function questions(Request $request)
    {
        if($request->input('q', false))
            $questions = ServiceQuestion::where('name', 'like', '%'.$request->input('q').'%')->paginate();
        else
            $questions = ServiceQuestion::paginate();

        return $questions;
    }


    private function handleSlug(Service $service)
    {
        $slug = str_slug($service->name);
        $s = Service::where('slug', $slug)
            ->where('id', '!=', $service->id)
            ->first();
        if(!is_null($s))
            $service->update(['slug' => $slug.'-'.$service->id]);
        else
            $service->update(['slug' => $slug]);
    }

    private function handleLocations(Service $service, $selectedLocations)
    {
        $service->states()->sync($selectedLocations);
    }

    private function resizedImage($path)
    {
        $img = \Image::make(storage_path('app/' . $path));
        $img->fit(600, 300);
        $filepath = str_replace('.', '-600x300.', $path);
        $img->save(storage_path('app/' . $filepath));

        return $filepath;

    }
}
