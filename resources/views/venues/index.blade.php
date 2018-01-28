
@extends('layouts.master')

@section('content')

@foreach($venues as $venue)
    <li> <a href='venues/{{$venue->id}}' > {{$venue->name}} - {{ $venue ->description }} </a></li>
@endforeach

@endsection