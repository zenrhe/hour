<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Venue;

class VenueController extends Controller
{
    public function index()
    {  
        $venues = Venue::get();

        return view('venues.index', compact('venues'));

    }
    public function show(Venue $venue)
    { 

        $logs = Log::where('venue_id',$venue->id)->get();

        return view('venue.show', compact('venue', 'logs'));
    }
}
