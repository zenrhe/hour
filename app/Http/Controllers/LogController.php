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

    public function create()
    {
        return view('logs.create')
            ->withVenues(Venue::all());// just more efficient
    }

    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'hours' => 'required',
            'dateWorked' => 'required|date',
            'venue_id' => 'required|integer',
            'description' => 'string|max:255',
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

        // The above probably works, but it's a paint to read and maintain
        // And the only thing it's doing really is merging in the user id
        // and now()
        // Try using this pattern instead:

        $log = Log::create(array_merge([
            'user_id' => Auth::user()->id,
            'submitted' => Carbon::now(),
        ], $validated));

        // see the code in VenueController to get this to work.
        // I would use the $log you just created to pull these values,
        // since the request() or $request version hasn't been validated.
        $request->session()->flash(
            'Log Added: '.request()->hours.' hours for '. request()->dateWorked
        );

        // here just redirect and let logs.index figure out what it needs to do when it loads
        return redirect(route('logs.index'));// need a named route for this to work
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
