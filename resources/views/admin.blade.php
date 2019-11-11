@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Admin</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    Welcome to the Administration Panel

                    <h2> Venue List</h2>
                    @include('venues.list')

                    <h2> User List</h2>
                    @include('users.list')

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
