@extends('layouts.master')

@section('content')
  <!--duplicate of users.show due to create form redirect-->
    <h2>{{ $user->first_name }} </h2>

    @if (!empty($success))
        @include('layouts.success')
    @endif
    @include('users.show')

    @if (!empty($success))
        @include('layouts.success')
    @endif
@endsection