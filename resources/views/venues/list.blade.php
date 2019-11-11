<table class="table table-striped sortable">
    <thead class="thead-inverse">
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>This Month</th>
            <th>Total</th>
        </tr>
    </thead>
    @foreach($venues as $venue)
    <tr>
        <td><a href='/venues/{{ $venue->id }}'> {{ $venue->name }}</a>
        </td>
        <td>{{ $venue->description }}</td>
        <td>{{ $venue->logs->where('submitted', '>=', Carbon\Carbon::now()->startOfMonth())->sum('hours') }}</td>
        <td>{{ $venue->logs->sum('hours') }}</td>
    </tr>
    @endforeach
</table>