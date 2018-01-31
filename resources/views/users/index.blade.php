
@extends('layouts.master')

@section('content')

<div id="view_user_list">

    <h2>Users</h2>
    <p><a href="/userlogs/?searchPeriod=12">Show All Logs</a><p>
    <br/>
        <table class="table table-striped sortable">
        <thead class="thead-inverse">
            <tr>
                <th>Name</th>
                <th>This Month</th>
                <th>Total</th>
            </tr>
        </thead>
            @foreach($users as $user)
            <tr>
                <td><a href='/users/{{ $user->id }}'> {{ $user->first_name, $user->last_name }}</a></td>
                <td>{{ $user->logs->where('submitted', '>=', Carbon\Carbon::now()->startOfMonth())->sum('hours') }}</td>
                <td>{{ $user->logs->sum('hours') }}</td>
           </tr>
           @endforeach
        </table>
</div>
@endsection