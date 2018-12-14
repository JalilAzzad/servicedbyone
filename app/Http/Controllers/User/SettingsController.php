<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\User\UpdateInfoRequest;
use App\Http\Requests\User\UpdatePasswordRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('verified');
    }

    /**
     * Show the application settings page for user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        return view('user.settings.index', ['user' => $user]);
    }


    /**
     * Show the application settings page for user.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateInfo(UpdateInfoRequest $request)
    {
        $data = $request->validated();
        auth()->user()->update($data);
        return redirect('/settings')->with('status', 'Your info is updated successfully!!!');
    }


    /**
     * Show the application settings page for user.
     *
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(UpdatePasswordRequest $request)
    {
        $data = $request->validated();
        if(Hash::check($data['current_password'], auth()->user()->getAuthPassword()))
        {
            $request->user()->fill([
                'password' => Hash::make($data['new_password'])
            ])->save();
            return redirect('/settings')->with('status', 'Your password is updated successfully!!!');
        } else {
            return redirect('/settings')->with('error', 'Your current password dont match our records!!!');
        }
    }
}
