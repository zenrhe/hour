<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->except('show');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles = Profile::get();

        return view('profiles.index', compact('profiles'));

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
    public function store(Request $request)
    {

    }
    
    /**
     * Update Contact Details
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateContactDetails(Request $request)
    {
        $data = $request->all(); // This will get all the request data.

        dd($data);


        // $validated = $this->validate($request, [
        //     'phone' => 'max:100',
        //     'email' => 'email',
        //     'address' => 'text',
        // ]);


        // $request->session()->flash(
        //     'success',
        //     'Request Happened ') 
        // );

        return back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    // public function show(Profile $profile)

    public function show(User $user)
    {
        //Only admins can view other users profiles. 
        //if current user matches search user then return the view
        //else check if admin or redirect
        $currentUser = Auth::user()->id;
        $searchUser = $user->id;
        
        //If Current user not viewing their own logs
        if($currentUser !== $user)
        {
            if(!Auth::user()->isAdmin())
            {
                $searchUser = $currentUser;
            }
        }
 
        $user = User::find($searchUser);
        $searchPeriod = 12;

        return view('profile.show2', compact('user', 'searchPeriod'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
