@extends('layouts.master')

@section('content')
  
  
  <?php //User Details Formatting      ?>    
    {{$user->first_name}} 

  <?php //Insert Logs for user ?>                
   @foreach($logs as $log)
    <li> <a href='logs/{{$log->id}}' > {{$log->user_id}} - {{ $log ->hours }} -  {{ $log ->description }} </a></li>
    @endforeach
    
@endsection