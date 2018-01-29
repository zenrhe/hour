
@extends('layouts.master')

@section('content')

{{$venue->name}} 

<?php //Insert Logs for user 
    //Check there are any logs?>                
    @include('venues.logs')

@endsection
                    
