<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Venue;
use App\User;
use App\Log;
use Carbon\Carbon;
use Session;


class VenueController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    public function index()
    {  
        $venues = Venue::get();

        return view('venues.index', compact('venues'));

    }
    public function show(Venue $venue)
    { 

        //$logs = Log::where('venue_id',$venue->id)->get(); //dont need when model has link
        $logs = Venue::find($venue->id )->logs;

        return view('venues.show', compact('venue', 'logs'));
    }

    public function create()
    {
        return view('venues.create');
    }

    public function store()
    {
        $this->validate(request(), [
            'name' => 'required',
            'description' => 'nullable|max:255',
        ]);

        Venue::create(request(['name','description']));
   

        //Redirect from venues/create to venues
        $successMsg = 'Venue: '.request()->name.' was added';
        $venues = Venue::get();
        return view('venues.index', compact('venues'))->withSuccess($successMsg);      
    }
}
