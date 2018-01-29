
<table class="table table-striped sortable">
    <thead class="thead-inverse">
       <tr>
       <th>User</th>
        <th>Hours</th>
        <th>Date</th>
        <th>App'd</th>
        <th>Approved By</th>
        <th>Approved At</th>

        <!-- <th>Description</th> -->
      </tr>
    </thead>

    @foreach($venue->logs as $log)
        <tr>
            <td>{{ $log->user->first_name , $log->user->last_name}}</td> 
            <td>{{ $log->hours}}</td>
            <td>{{ date('jS M y', strtotime($log->submitted)) }}</td> 

            @if($log->approvedAt !=null)
            <td> <input type='checkbox' checked='checked'> </td>
            <td>{{ $log->user->first_name , $log->user->last_name}}  </td> 
            <td>{{  date('jS M y', strtotime($log->approvedAt)) }}</td> 
            
            @else
            <td> <input type='checkbox'> </td>
            <td colspan="2">{{ $log->description }} </td> 
 
            @endif
        </tr>
    @endforeach

    </table>

<hr/>