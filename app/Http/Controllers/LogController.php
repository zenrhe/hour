<?php

namespace App\Http\Controllers;

use Auth;
use App\Log;
use Session;
use App\User;
use App\Venue;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function create2()
    {
        return view('logs.create')
            ->withVenues(Venue::all());// just more efficient
    }

    public function create()
    {
        $venues = Venue::get(); //To Populate Selection 
        $user = Auth::user(); //for profile header

        return view('logs.create2', compact('venues', 'user'));
    }

    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'hours' => 'required',
            'dateWorked' => 'required|date',
            'venue' => 'required|integer',
            'description' => 'string|max:255',
        ]);

        $log = new Log;

        $log->user_id = auth()->id();
        $log->hours = request('hours');
        $log->dateWorked = request('dateWorked');
        $log->description = request('description');
        $log->venue_id = request('venue');
        $log->submitted = \Carbon\Carbon::now();
        $log->approvedBy = NULL;
        $log->approvedAt = NULL;

        $log->save();

        $request->session()->flash(
            'success',
            'Log Added: '.$log->hours.' hours for '.$log->dateWorked->format('jS \o\f F, Y ').' at '.$log->venue->name 
        );

        return redirect(route('users.show', ['id' =>auth()->id()]));
    }

    public function index()
    {
        return view('logs.index')
            ->withLogs(Log::all());

        return view('venues.logsAll', compact('venues','logs','searchPeriod' ));
    }

    public function show(Log $log)
    {
        return view('logs.show')
            ->withLog($log);
    }

    public function getUserLogs()
    {
       $searchPeriod = request('searchPeriod','12'); 

       $usersLogs = Log::latest()
            ->with('user')
            ->months($searchPeriod)
            ->get()
            ->groupBy('user_id');
            //TODO sortby   

        $users = User::hasLogsInPeriod($searchPeriod);
    
        return view('users.logsAll', compact('users', 'searchPeriod'));
    }

    public function getVenueLogs()
    {
        $searchPeriod = request('searchPeriod','12'); 

        $venues = Venue::get(); //still want to see all venues, even with no logs unlike userlogs

        $logs = Log::latest()
            ->months($searchPeriod)
            ->get();

        return view('venues.logsAll', compact('venues','logs','searchPeriod' ));
    }
}
