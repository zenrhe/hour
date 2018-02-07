@extends('layouts.master')

@section('content')
  
    <h2>{{ Auth::user()->name}} </h2>

    @if (session()->has('success'))
        @include('layouts.success')
    @endif

    
@endsection