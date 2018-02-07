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
    }

    public function show(Log $log)
    {
        return view('logs.show')
            ->withLog($log);
    }

    // I'm just gonna leave this alone, but I think maybe back up and try again here... ;)
    public function getUserLogs()
    {
        //$searchPeriod = 12;
        // if(request(['searchPeriod']) != '' && !NULL){
        //     $searchPeriod = request(['searchPeriod']);
        // }

        //Default not work when req should be empty
        //$searchPeriod = $request->input('searchPeriod', '12');

       $searchPeriod = request(['searchPeriod', '[12]']); //using this , but with defualt not working
       //Suggestion:  $request->get(‘searchPeriod’, ‘12’)
       //$searchPeriod = $request->get(‘searchPeriod’, ‘12’); //Undefined variable: request

       $logs = Log::latest()
            ->filter($searchPeriod)
            ->get();

        //Want to only get users contained in the filters $logs above
        //Issue see users who dont have any logs

       // $users = User::whereHas('logs')->filter($searchPeriod)->get();

       $users = User::get();

        //$filteredUsers = $logs->user->get(); //Property [user] does not exist
        //$filteredUsers = $logs->user; //Property [user] does not exist
        //$filteredUsers = $logs->user(); //Method [user] does not exist
        //$filteredUsers = $logs->users(); //Method [users] does not exist

        //$filteredUsers = $logs->users(User::get());
        //$filteredUsers = User::all()->where('$logs->user_id')->get();
        //$filteredUsers = $users->logs()->filter($searchPeriod); //Property [logs] does not exist
        //$filteredUsers = $users->logs->filter($searchPeriod); //Property [logs] does not exist
        //$filteredUsers = User::logs()->filter($searchPeriod); //Non-static method logs()
        //$filteredUsers = User::->logs->filter($searchPeriod); //Property [logs] does not exist
        //$user->logs->where //this syntax works in other locals so logs does exist

        return view('users.logsAll', compact('users', 'logs', 'searchPeriod'));
    }

    // This can be... easier...
    // But I'll let you puzzle that one out. :)
    public function getVenueLogs()
    {
        $searchPeriod = request(['searchPeriod']);

        $venues = Venue::get();

        $logs = Log::latest()
            ->filter($searchPeriod)
            ->get();

        return view('venues.logsAll', compact('venues','logs','searchPeriod' ));
    }
}
