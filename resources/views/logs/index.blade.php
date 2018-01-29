@extends('layouts.master')

@section('content')

@foreach($logs as $log)
    <li> {{$log->id}} - {{ $log ->description }}</li>
@endforeach

@endsection