
<!--TODO Only Display if-->
<table class="table table-striped sortable">
    <thead class="thead-inverse">
       <tr>
        <th><i class="fa fa-clock fa-fw fa-2x"></i></th>
        <th style="width:8em"><i class="far fa-calendar-alt fa-2x"></i></th>
        <th style="width:10em"><i class="fas fa-home fa-2x"></i></th>
        <th></th>
        <th></th>
        <!-- <th>Approved By</th>
        <th>Approved At</th> -->

        <!-- <th>Description</th> -->
      </tr>
    </thead>
    
    @foreach($user->logs()->months($searchPeriod)->get() as $log)
        <tr>
            <td align="center"><strong>{{ $log->hours }}</strong></td>
            <td>{{ date('jS M y', strtotime($log->dateWorked)) }}</td> 
            <td>{{ $log->venue->name }}</td> 
            <td>{{ $log->description }}</td> 

            @if($log->approvedAt !=null)
            <td> 
                <i class="fas fa-check fa-lg" style="color:green"></i></i>
            </td>
            <!--Show Approval Information
            <!-- <td>{{ $log->approvedBy }}  </td>  -->
            <!-- <td> $log->approvedBy->first_name </td>  -->
            <!-- <td>{{  date('jS M y', strtotime($log->approvedAt)) }}</td>  -->
            @else
            <td>  
            </td>
            <!-- <td colspan="2">{{ $log->description }} </td>  -->
 
            @endif
        </tr>
    @endforeach

    </table>

<hr/>