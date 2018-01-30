<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Log;
use App\User;
use App\Venue;
use Carbon\Carbon;
use Auth;

class LogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create()
    {
        //TODO Get Logged In User
        //this is done in Store
        //likely remove the below

        $user = Auth::user();
        $venues = Venue::get();

        return view('logs.create', compact('user', 'venues'));
    }
    public function store(Request $request)
    {
        //dd($request->all());

        $this->validate(request(), [
            'hours' => 'required',
            'dateWorked' => 'required|date',
            'venue_id' => 'required',
            'description' => 'nullable|max:255',
        ]);

        $log = new Log;

        $log->user_id = auth()->id();
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
            'UsersController@show', Auth::user()
        );      
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

    public function getUserLogs()
    {
        $users = User::get();

        return view('users.logsAll', compact('users'));
    }

    public function getVenueLogs()
    {
        $venues = Venue::get();

        return view('venues.logsAll', compact('venues'));
    }

}
