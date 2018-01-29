<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Log;
use App\Venue;

class UsersController extends Controller
{
    public function index()
    {  
        $users = User::get();

        return view('users.index', compact('users'));

    }
    public function show(User $user)
    {
        
        $logs = Log::where('user_id',$user->id)->get();

        return view('users.show', compact('user', 'logs'));
    }

    //TODO Show User and Logs for them
}
