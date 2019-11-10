<?php

namespace App\Http\Controllers;

use App\Log;
use Session;
use App\User;
use App\Venue;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VenueController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware('admin');
    }

    public function index()
    {
        $venues = Venue::get();

        return view('venues.index', compact('venues'));

        // return view('venues.index')
        //     ->withVenue(Venue::all());
    }

    public function show(Venue $venue)
    {
        // You can just reference $venue->logs in your view
        // You already have that relationship defined in App\Venue
        // So don't need the following line.
        //
        //$logs = Venue::find($venue->id )->logs;
        $logs = Log::where('venue_id',$venue->id)->get();

        return view('venues.show', compact('venue', 'logs'));
        
        // return view('venues.show')
        //     ->withVenue($venue);
    }

    public function create()
    {
        return view('venues.create');
    }

    /**
     * A store method will normally always get a Request passed into it, same for Update.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'name' => 'required|string',
            'description' => 'string|max:255',
            // nullable is a migration thing. Just don't put "required" if it's not required.
        ]);

        Venue::create($validated);

        //Redirect from venues/create to venues
        $request->session()
            ->flash('success', 'Venue: '.request()->name.' was added');

        return redirect(route('venues.index'));
    }

    /**
     * [update description] TODO 
     * @param  Request $request [description]
     * @param  Venue   $venue   [description]
     * @return [type]           [description]
     */
    public function update(Request $request, Venue $venue)
    {
        // for example
    }
}
