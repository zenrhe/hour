<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Log;

class LogController extends Controller
{
    public function index()
    {  
        $logs = Log::get();

        return view('logs.index', compact('logs'));

    }
    public function show(Log $log)
    {
        return view('logs.show', compact('log'));
    }

    public function getUserLogs(User $user)
    {
        //Not tested
        $logs = Log::where('user_id', $user->id )->get();

        //return view('user.logs', compact('logs'));
        return $logs;
    }

    public function getVenueLogs(Venue $venue)
    {
        
    }
}
