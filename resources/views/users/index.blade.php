@extends('layouts')

@section('content')

@foreach($users as $user)
    <li> <a href='{{$user->id}}' > {{$user->first_name}} - {{ $user ->email }} </a></li>
@endforeach

@endsection
