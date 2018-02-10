<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use App\Log;
use App\Venue;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use Session;
use Carbon\Carbon;

class ProfileController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware('admin')->except('show', 'update');
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
    public function updateContactDetails(User $user, Request $request)
    {

        $validated = $this->validate($request, [
            'phone' => 'max:100',
            'email' => 'email',
            'address' => 'max:200',
        ]);

        //First Udate Profile
        $profile = Profile::find($user->profile->id);

            $profile->phone = request('phone');
            $profile->address = request('address');

        $profile->save();
        $request->session()->flash(
            'success',
            'Contact Details Updated'
        );

        //Then Update User
        //TODO this save isn't working
        $updateUser = User::find($user->id);
            $updateUser->email = request('email');
        $updateUser->save();
        $request->session()->flash(
            'error',
            'Currently you cannot update the email address'
        );
    }
        /**
     * Update Bio (position and description)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateBio(User $user, Request $request) 
    {
        $validated = $this->validate($request, [
            'position' => 'max:200',
            'description' => 'max:200',
        ]);

        //First Update Profile
        $profile = Profile::find($user->profile->id);

            $profile->position = request('position');
            $profile->description = request('bio');

        $profile->save();
        $request->session()->flash(
            'success',
            'Bio Updated'
        );

    }
        /**
     * Update Venue Details
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateVenues(User $user, Request $request)
    {
        $data = $request->all(); // This will get all the request data.

        dd($data);
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
    public function update(User $user, Request $request)
    {

        //Profile is split into diff sections
        $updatearea = request('section');

        if($updatearea == 'contact'){
            
            $this->updateContactDetails($user, $request);
        } 
        elseif($updatearea == 'bio'){
            
            $this->updateBio($user, $request);
        }
        // elseif($updatearea = 'venues'){
        //     $this->updateVenues($user, $request);
        // }

        return back();
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
