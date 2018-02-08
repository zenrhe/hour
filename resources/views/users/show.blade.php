@extends('layouts.master')

@section('content')
  
<div class="profile_header">
    <div class="row">    
        <div class="col-lg-12 col-sm-12">
            <div class="profile_name">
                <h3>{{ $user->name}} </h3>
            </div>
        </div>
    </div>
    <div class="row" >
        <div class="col-sm">
            <div class="avatar">
                <img src="{!! $user->avatar() !!}" alt="">
            </div>
        </div>
        <div class="col-sm">
            <div class="circle-tile ">
                <a href="#"><div class="circle-tile-heading green"><i class="fa fa-clock fa-fw fa-4x"></i></div></a>
                <div class="circle-tile-content green">
                    <div class="circle-tile-description text-faded">This Month</div>
                    <div class="circle-tile-number text-faded ">
                    {{ $user->logs->where('submitted', '>=', Carbon\Carbon::now()->startOfMonth())->sum('hours') }} 
                    </div>
                <!-- <a class="circle-tile-footer" href="#">More Info <i class="fa fa-chevron-circle-right"></i></a> -->
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="circle-tile ">
                <a href="#"><div class="circle-tile-heading dark-blue"><i class="fa fa-clock fa-fw fa-4x"></i></div></a>
                <div class="circle-tile-content dark-blue">
                    <div class="circle-tile-description text-faded">Last Month</div>
                    <div class="circle-tile-number text-faded ">12</div>
                </div>
            </div>
        </div>
    <div class="col-sm">
        <div class="circle-tile ">
            <a href="#"><div class="circle-tile-heading red"><i class="fa fa-clock fa-fw fa-4x"></i></div></a>
            <div class="circle-tile-content red">
            <div class="circle-tile-description text-faded">Total</div>
            <div class="circle-tile-number text-faded ">
                {{ $user->logs->sum('hours') }}
            </div>
        </div>
        </div>
    </div>
  </div>

    
    </div> 
    </div>
</div>
    @if (session()->has('success'))
        @include('layouts.success')
    @endif

    
 
    <!-- <h4>This Month: {{ $user->logs->where('submitted', '>=', Carbon\Carbon::now()->startOfMonth())->sum('hours') }} - Total: {{ $user->logs->sum('hours') }}</h4> -->
       
    @include('users.logs')

@endsection