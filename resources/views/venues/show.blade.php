
@extends('layouts.master')

@section('content')

<h2>{{$venue->name}} </h2>
<h4>This Month: {{ $venue->logs->where('submitted', '>=', Carbon\Carbon::now()->startOfMonth())->sum('hours') }} - Total: {{ $venue->logs->sum('hours') }}</h4>

                
    @include('venues.logs')

@endsection
                    
