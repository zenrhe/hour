<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Log;
use App\User;
use App\Venue;
use Carbon\Carbon;
use Auth;
use Session;
class LogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    public function create()
    {
        $venues = Venue::get(); //To Populate Selection 

        return view('logs.create', compact('venues'));
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
        
        //TODO replace with Create function 
        // Venue::create(request(['auth()->id()','hours', 'dateWorked','description','venue_id']));
   
        //Redirect from logs/create to /users/{id}
        $successMsg = 'Log Added: '.request()->hours.' hours for '. request()->dateWorked;

        //Wont Flash. Wont Redirect with message. Using view always goes to /logs
        //$request->session()->flash('success', '$successMsg'); //fails
        //\Session::flash('success','$successMsg'); //fails
        //return redirect()->action('UsersController@show', Auth::user())->withSuccess($successMsg); //fails msg 
        
        $logs = Log::where('user_id', 'Auth::user()->id');
        $user = User::find(Auth::user()->id);
        return view('logs.index', compact('user','logs'))->withSuccess($successMsg);//will always go to /logs@index
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
