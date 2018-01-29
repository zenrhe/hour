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
        return view('venues.show', compact('venue'));
    }

    //TODO Show Venue and Logs for them
}
