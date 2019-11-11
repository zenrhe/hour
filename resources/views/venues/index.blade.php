
@extends('layouts.master')

@section('content')

<div id="view_venue_list">

    <h2>Venues</h2>
    <p><a href="/venuelogs/?searchPeriod=12">Show All Logs</a><p>
    <br/>
    @if (session()->has('success'))
        @include('layouts.success')
    @endif
        
        @include('venues.list')
</div>
@endsection
