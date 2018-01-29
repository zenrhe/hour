
<table class="table table-striped sortable">
    <thead class="thead-inverse">
       <tr>
        <th>Hours</th>
        <th>Date</th>
        <th>Venue</th>
        <th>Description</th>
        <th>App'd</th>
        <th>Approved By</th>
        <th>Approved At</th>

        <!-- <th>Description</th> -->
      </tr>
    </thead>

    @foreach($user->logs as $log)
        <tr>
            <td>{{ $log->hours }}</td>
            <td>{{ date('jS M y', strtotime($log->submitted)) }}</td> 
            <td>{{ $log->venue->name }}</td> 
            <td>{{ $log->description }}</td> 

            @if($log->approvedAt !=null)
            <td> <input type='checkbox' checked='checked'> </td>
            <td>{{ $log->approvedBy }}  </td> 
            <!-- <td> $log->approvedBy->first_name </td>  -->
            <td>{{  date('jS M y', strtotime($log->approvedAt)) }}</td> 
            
            @else
            <td> <input type='checkbox'> </td>
            <td colspan="2">{{ $log->description }} </td> 
 
            @endif
        </tr>
    @endforeach

    </table>

<hr/>