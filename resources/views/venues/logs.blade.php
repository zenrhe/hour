
{{$venue->name}}
@foreach($logs as $log)
    <li> {{$log->user_id}} - {{ $log ->hours }} -  {{ $log ->description }}</li>
    @endforeach
    