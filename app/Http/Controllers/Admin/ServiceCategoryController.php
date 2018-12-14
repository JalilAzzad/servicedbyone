<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\StoreAndUpdateServiceCategoryRequest;
use App\Models\ServiceCategory;
use App\Models\User;
use App\Models\Seo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ServiceCategoryController extends Controller
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
        $categories = ServiceCategory::paginate();
        $baseUrl=url('/');
        $currentUrl=url()->current();
        $currentUrl=str_replace($baseUrl,"",$currentUrl); 
        $seo = Seo::where('url', '=', 'https://servicedbyone.com'.$currentUrl)->first();
        return view('admin.services.categories.index', ['categories' => $categories,'seo'=>$seo]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAndUpdateServiceCategoryRequest $request)
    {
        $validated = $request->validated();
        $category = ServiceCategory::create([
            'name' => $validated['name']
        ]);
        if(isset($validated['featured_image']))
        {
            $path = $validated['featured_image']->store('public/service_categories/' . $category->id);
            $category->update(['featured_image' => $path]);
        }
        $this->handleSlug($category);
        return redirect('/admin/service-categories')->with('status', 'Service Category is created successfully!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServiceCategory  $serviceCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceCategory $serviceCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServiceCategory  $serviceCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $serviceCategory = ServiceCategory::findOrFail($id);
        $baseUrl=url('/');
        $currentUrl=url()->current();
        $currentUrl=str_replace($baseUrl,"",$currentUrl); 
        $seo = Seo::where('url', '=', 'https://servicedbyone.com'.$currentUrl)->first();
        return view('admin.services.categories.edit', ['category' => $serviceCategory,'seo'=>$seo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ServiceCategory  $serviceCategory
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAndUpdateServiceCategoryRequest $request, $id)
    {
        $validated = $request->validated();
        $category = ServiceCategory::findOrFail($id);
        $category->update([
            'name' => $validated['name']
        ]);
        if(isset($validated['featured_image']))
        {
            if(!is_null($category->featured_image))
                Storage::delete($category->featured_image);
            $path = $validated['featured_image']->store('public/service_categories/' . $category->id);
            $category->update(['featured_image' => $path]);
            $category->update(['resized_featured_image' => $this->resizedImage($path)]);
        }
        $this->handleSlug($category);
        return redirect('/admin/service-categories')->with('status', 'Service Category is updated successfully!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceCategory  $serviceCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $serviceCategory = ServiceCategory::findOrFail($id);
        $serviceCategory->delete();
        return redirect('/admin/service-categories')->with('status', 'Service Category is deleted successfully!!!');
    }


    private function handleSlug(ServiceCategory $serviceCategory)
    {
        $slug = str_slug($serviceCategory->name);
        $s = ServiceCategory::where('slug', $slug)
            ->where('id', '!=', $serviceCategory->id)
            ->first();
        if(!is_null($s))
            $serviceCategory->update(['slug' => $slug.'-'.$serviceCategory->id]);
        else
            $serviceCategory->update(['slug' => $slug]);
    }


    private function resizedImage($path)
    {
        $img = \Image::make(storage_path('app/' . $path));
        $img->fit(800, 800);
        $filepath = str_replace('.', '-800x800.', $path);
        $img->save(storage_path('app/' . $filepath));

        return $filepath;

    }
}
