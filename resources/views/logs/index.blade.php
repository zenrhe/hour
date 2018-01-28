
@foreach($logs as $log)
    <li> <a href='logs/{{$log->id}}' > {{$log->user_id}} - {{ $log ->hours }} -  {{ $log ->description }} </a></li>
@endforeach
