<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\StoreSeo;
use App\Http\Requests\Admin\UpdateSeo;
use App\Models\User;
use App\Models\Seo;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

class SeoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:'.User::ADMIN);
    }

    public function index()
    {
        $seos=Seo::paginate(10);
        return view('admin.seos.index', ['seos' => $seos]);
    }
    //
    public function create()
    { 
        return view( 'admin.seos.create' );
    }


     public function store(StoreSeo $request)
    {
        $validated = $request->validated();
        $seo = Seo::create([
            'url' => $validated['url'],
            'slug' => $validated['slug'],
            'keywords' => $validated['keywords'],
            'meta_desc' => $validated['meta_desc'],
            
        ]);
        return redirect('/admin/seos')->with('status', 'Seo entry successfull!!!');
    }


    public function show(Seo $seo)
    {
        return view('admin.seos.show',['seo1'=>$seo]);
    }

    public function edit(Seo $seo)
    {
        return view('admin.seos.edit',['seo1'=>$seo]);
    }

    public function update(UpdateSeo $request, Seo $seo)
    {
        $validated = $request->validated();
        $seo->slug = $validated['slug'];
        $seo->keywords = $validated['keywords'];
        $seo->meta_desc = $validated['meta_desc'];
        
        $seo->save();
        return redirect('/admin/seos')->with('status', 'Seo entry updated successfull!!!');
    }


    public function destroy(Seo $seo)
    {
        $seo->delete();
        return redirect('/admin/seos')->with('status', 'Seo entry deleted successfull!!!');
    }


}
