@extends('layouts.master')

@section('content')
  

    <h2>{{ $user->first_name }} </h2>
    <h4>This Month: {{ $user->logs->where('submitted', '>=', Carbon\Carbon::now()->startOfMonth())->sum('hours') }} - Total: {{ $user->logs->sum('hours') }}</h4>
       
    @include('users.logs')

@endsection