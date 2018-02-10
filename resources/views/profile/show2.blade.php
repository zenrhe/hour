@extends('layouts.master')
@section('pageTitle', '{{ $user->name}}')

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
                <a href="#" target="_blank" class="fab fa-facebook-square fa-2x"></a>

            </div>
        </div>
        <div class="col-sm">
            <div class="circle-tile ">
                <a href="#"><div class="circle-tile-heading green"><i class="fa fa-clock fa-fw fa-4x"></i></div></a>
                <div class="circle-tile-content green">
                    <div class="circle-tile-description text-faded">This Month</div>
                    <div class="circle-tile-number text-faded ">
                    {{ $user->logs->where('dateWorked', '>=', Carbon\Carbon::now()->startOfMonth())->sum('hours') }} 
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

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="profile_main">
    <div class="row">    
        <div class="col-sm-6 col-md-4 col-12">
            <div class="contact_details ">
                <div class="profile_card_header"><i class="fas fa-address-card"></i>  Contact Details</div>
                <ul class="submenu">
                    <li><a href="#"><i class="fas fa-phone-square"></i>  
                        Phone : 
                        <span id="phone" class="edit" contenteditable>
                        {{ $user->profile->phone}}</span></a></li>

                    <li><a href="#"><i class="fas fa-envelope-square"></i>
                        Email : 
                        <span id="email" class="edit" contenteditable>
                        example@test.com </span></a></li>
                
                    <!-- <li><a href="#"><i class="fa fa-calendar left-none"></i> Date of Birth : {{ date('jS M y', strtotime($user->profile->dob)) }} </a></li> -->
                    <li><a href="#"><i class="fas fa-map-marker"></i>
                        Address : 
                        <span id="address" class="edit" contenteditable>
                        {{ $user->profile->address}}</span></a></li>
                </ul>
                </div>
                <div class="profile_card_header save" style="margin-top:-1em"><a href="#" onCLick="saveContactDetails()"><i class="fas fa-check fa-lg" style="color:green"></i>   Save</div>
            </div>
            <div class="col-sm-6 col-md-4 col-12">
                <div class="profile_details ">
                    <div class="profile_card_header"><i class="fas fa-info-circle"></i>  Info</div>
                        <ul class="submenu">
                            <li><a href="#"><strong>Position: </strong><br/>
                                {{ $user->profile->position}}</a></li>
                            <li><a href="#"><strong>Bio: </strong><br/>
                                {{ $user->profile->description}}</a></li>
                        

                        </ul>
                    </div>
                </div>
    <div class="col-sm-6 col-md-4 col-12">
            <div class="default_venues">
                <div class="profile_card_header"><i class="fas fa-building"></i> Default Venues</div>
                <ul class="submenu">
                <li><a href="#" role="button" id="venue_{{ $user->profile->venue1->name}}" class="btn btn-default">
                    <i class="fas fa-home fa-1x"></i>  
                    {{ $user->profile->v1name}}
                    ( {{ $user->logs->where('dateWorked', '>=', Carbon\Carbon::now()->startOfMonth())->sum('hours') }} /
                    {{ $user->logs->sum('hours') }} )
                    </a>
                </li>
                <li><a href="#" role="button" id="venue_{{ $user->profile->venue1->name}}" class="btn btn-default">
                    <i class="fas fa-home fa-1x"></i>  
                    {{ $user->profile->v2name}}
                    ( {{ $user->logs->where('dateWorked', '>=', Carbon\Carbon::now()->startOfMonth())->sum('hours') }} /
                    {{ $user->logs->sum('hours') }} )
                </a>
                </li>
                <li><a href="#" role="button" id="venue_{{ $user->profile->venue1->name}}" class="btn btn-default">
                    <i class="fas fa-home fa-1x"></i>  
                    {{ $user->profile->v3name}}
                    ( )
                </a>
                </li>
                </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="profile_card_header"><i class="fas fa-hourglass"></i>  Hours Logged </div>


    @if (session()->has('success'))
        @include('layouts.success')
    @endif

    
 
    <!-- <h4>This Month: {{ $user->logs->where('submitted', '>=', Carbon\Carbon::now()->startOfMonth())->sum('hours') }} - Total: {{ $user->logs->sum('hours') }}</h4> -->
       
    @include('users.logs')

@endsection

@section('footer')

<script type="text/javascript">
 
 function saveContactDetails() {
        
    data = {};
    data['phone'] = document.getElementById('phone').innerHTML
    data['email'] = document.getElementById('email').innerHTML
    data['address'] = document.getElementById('address').innerHTML


    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    var $url = window.location.href;
    // alert($url);
    
    $.ajax({
        type:'POST',
        url: '/ajaxRequest',
        dataType: 'text/plain',
        data: data,
        success:function(msg){
            alert(msg.success);
            console.log(msg);
        },
    });
    
}

    // function saveContactDetails2(){

    //   alert('test');
    // // data = {};
    // // data['val'] = $(this).text();
    // // data['id'] = $(this).parent('tr').attr('data-row-id');
    // // data['index'] = $(this).attr('col-index');
    // //   if($(this).attr('oldVal') === data['val'])
    // // return false;
    
    // });
    // $.ajax({   
          
    //       type: "POST",  
    //       url: "server.php",  
    //       cache:false,  
    //       data: data,
    //       dataType: "json",       
    //       success: function(response)  
    //       {   
    //         //$("#loading").hide();
    //         if(response.status) {
    //           $("#msg").removeClass('alert-danger');
    //           $("#msg").addClass('alert-success').html(response.msg);
    //         } else {
    //           $("#msg").removeClass('alert-success');
    //           $("#msg").addClass('alert-danger').html(response.msg);
    //         }
    //       }   
    //     });


</script>

@endsection