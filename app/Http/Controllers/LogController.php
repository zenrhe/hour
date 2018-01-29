<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Log;
use App\User;
use App\Venue;

class LogController extends Controller
{
    public function create()
    {
        //TODO Get Logged In User
        //$user = User::find($id);

        $user = User::find(1);
        $venues = Venue::get();

        return view('logs.create', compact('user', 'venues'));
    }
    public function store(Request $request)
    {
        //dd($request->all());
        $log = new Log;

        $log->user_id = request('user_id');
        $log->hours = request('hours');
        $log->dateWorked = request('dateWorked');
        $log->description = request('description');
        $log->venue_id = request('venue_id');
        $log->submitted = \Carbon\Carbon::now();
        $log->approvedBy = NULL;
        $log->approvedAt = NULL;
        
        $log->save();

        $id = request('user_id');
   
        return redirect()->action(
            'LogController@getUserLogs', ['id' => $id]
        );       
    }

    
    public function getVenueLogs(Venue $venue)
    {
        //Not tested
        $logs = Log::where('venue_id', $venue->id )->get();

        return $logs;
    }
    
    public function index()
    {  
        $logs = Log::get();

        return view('logs.index', compact('logs'));

    }
    public function show(Log $log)
    {
        return view('logs.show', compact('log'));
    }

    // public function getUserLogs(User $user)
    // {
        
    //     //$logs = Log::where('user_id', $user->id )->get();

    //     $logs = User::find($user->id )->logs;

    //     return view('logs.user', compact('logs', 'user'));

    // }

}
