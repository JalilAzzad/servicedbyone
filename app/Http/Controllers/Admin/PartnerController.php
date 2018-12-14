<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\StorePartnerRequest;
use App\Http\Requests\Admin\UpdatePartnerRequest;
use App\Models\Partner;
use App\Models\User;
use App\Models\Seo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
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
        $partners = Partner::paginate(10);
     
        $baseUrl=url('/');
        $currentUrl=url()->current();
        $currentUrl=str_replace($baseUrl,"",$currentUrl); 
        $seo = Seo::where('url', '=', 'https://servicedbyone.com'.$currentUrl)->first();
        return view('admin.partners.index', ['partners' => $partners,'seo' =>$seo]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.partners.create', []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePartnerRequest $request)
    {
        $validated = $request->validated();

        // Substitue white spaces with dash
        $validated['slug'] = str_replace(' ','-',$validated['slug']);
        $partner = Partner::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'url' => $validated['website'],
            'slug' => $validated['slug'],
            'description' => $validated['description']
        ]);

        $path = isset($validated['featured_image']) ? $validated['featured_image']->store('public/partners/'. $partner->id) : null;
        $partner->update(['featured_image' => $path]);
        $partner->update(['resized_featured_image' => $this->resizedImage($path)]);
        return redirect('/admin/partners')->with('status', 'Partner is created successfully!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function show(Partner $partner)
    {
        $baseUrl=url('/');
        $currentUrl=url()->current();
        $currentUrl=str_replace($baseUrl,"",$currentUrl); 
        $seo = Seo::where('url', '=', 'https://servicedbyone.com'.$currentUrl)->first();
        return view('admin.partners.show', ['partner' => $partner,'seo'=>$seo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function edit(Partner $partner)
    {

        $baseUrl=url('/');
        $currentUrl=url()->current();
        $currentUrl=str_replace($baseUrl,"",$currentUrl); 
        $seo = Seo::where('url', '=', 'https://servicedbyone.com'.$currentUrl)->first();
        return view('admin.partners.edit', ['partner' => $partner,'seo'=>$seo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePartnerRequest $request, Partner $partner)
    {
        $validated = $request->validated();

        // Substitue white spaces with dash
        $validated['slug'] = str_replace(' ','-',$validated['slug']);
        $partner->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'url' => $validated['website'],
            'slug' => $validated['slug'],
            'description' => $validated['description'],
        ]);
     
        if(isset($validated['featured_image']))
        {
            if(!is_null($partner->featured_image))
            {
                Storage::delete($partner->featured_image);
                Storage::delete($partner->resized_featured_image);
            }
            $path = $validated['featured_image']->store('public/partners/' . $partner->id);
            $partner->update(['featured_image' => $path]);
            $partner->update(['resized_featured_image' => $this->resizedImage($path)]);
        }
        return redirect('/admin/partners')->with('status', 'Partner is updated successfully!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partner $partner)
    {
        $partner->delete();
        return redirect('/admin/partners')->with('status', 'Partner is deleted successfully!!!');
    }


    /**
     * Return the resized image path from freatured image path.
     *
     * @param  featured_image path
     * @return resized image path
     */

    private function resizedImage($path)
    {
        $img = \Image::make(storage_path('app/' . $path));
        $img->fit(600, 300);
        $filepath = str_replace('.', '-600x300.', $path);
        $img->save(storage_path('app/' . $filepath));

        return $filepath;

    }
}
