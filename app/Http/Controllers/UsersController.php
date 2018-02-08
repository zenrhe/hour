<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Log;
use App\Venue;
use Carbon\Carbon;
use Auth;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->except('show');
    }
    
    public function index()
    {  
        $users = User::get();

        return view('users.index', compact('users'));

    }
    public function show(User $user)
    {
        //Only admins can view other users logs. 
        //if current user matches search user then return the view
        //else check if admin or redirect
        $currentUser = Auth::user()->id;
        $searchUser = $user->id;
        
        //If Current user not viewing their own logs
        if($currentUser !== $searchUser)
        {
            if(!Auth::user()->isAdmin())
            {
                $searchUser = $currentUser;
            }
        }
        $logs = User::find($searchUser)->logs;
        $user = User::find($searchUser);
        $searchPeriod = 12;
        
        return view('users.show', compact('user', 'logs', 'searchPeriod'));
    } 
}
