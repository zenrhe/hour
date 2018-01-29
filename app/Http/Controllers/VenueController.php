<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Venue;
use App\User;
use App\Log;
use Carbon\Carbon;


class VenueController extends Controller
{
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
}
