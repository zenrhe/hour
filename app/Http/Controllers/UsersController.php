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

       return $currentUser;
       // $logs = Log::where('user_id',$user->id)->get();
        $logs = User::find($user->id )->logs;

        return view('users.show', compact('user', 'logs'));
    } 
}
