
@extends('layouts.master')

@section('content')

<div id="view_venue_list">

    <h2>Venues</h2>
    <p><a href="/venuelogs/?searchPeriod=12">Show All Logs</a><p>
    <br/>
        <table class="table table-striped sortable">
        <thead class="thead-inverse">
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>This Month</th>
                <th>Total</th>
            </tr>
        </thead>
            @foreach($venues as $venue)
            <tr>
                <td><a href='/venues/{{ $venue->id }}'> {{ $venue->name }}</a>
                </td>
                <td>{{ $venue->description }}</td>
                <td>{{ $venue->logs->where('submitted', '>=', Carbon\Carbon::now()->startOfMonth())->sum('hours') }}</td>
                <td>{{ $venue->logs->sum('hours') }}</td>
           </tr>
           @endforeach
        </table>
</div>
@endsection