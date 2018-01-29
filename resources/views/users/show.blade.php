@extends('layouts.master')

@section('content')
  
  
  <?php //User Details Formatting ?>    
    {{$user->first_name}} 

  <?php //Insert Logs for user 
    //Check there are any logs?>                
    @include('users.logs')

@endsection