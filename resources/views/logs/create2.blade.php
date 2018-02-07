@extends('layouts.master')

@section('content')


<div class="profile_header">
    <div class="row">
        <!-- <div class="col-sm">
            <div class="avatar">
                <a href="#"><img alt="" src="/images/profile_thumb.jpg"/></a>
            </div>
        </div> -->
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="circle-tile ">
                <a href="#"><div class="circle-tile-heading green"><i class="fa fa-clock fa-fw fa-4x"></i></div></a>
                <div class="circle-tile-content green">
                    <div class="circle-tile-description text-faded">This Month</div>
                    <div class="circle-tile-number text-faded ">
                      {{ $user->logs->where('submitted', '>=', Carbon\Carbon::now()->startOfMonth())->sum('hours')}}
                    </div>
                </div>
            </div>
        </div>  
    </div>
    <div class="row">    
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="profile_name center_div">
                <h3>{{Auth::user()->name}}</h3>
            </div>
        </div>
    </div>
  </div>
    </div> 
    </div>
</div>

<!-- HTML Form (wrapped in a .bootstrap-iso div) -->
<div class="bootstrap-iso center_div">
  <div class="container-fluid">
  <div class="row">
  <div class="col-md-6 col-sm-6 col-xs-12">

        <form method="POST" action="/logs">
        {{ csrf_field() }}
        
        @if(count($errors))
         @include('layouts.errors')
        @endif

          <div class="form-group ">
          <div class="input-group">
            <!-- Hours  -->
            <button type="button" class="btn btn-info btn-circle btn-xl" onClick="document.getElementById('hoursSelection').value =1">1</button>
            <button type="button" class="btn btn-info btn-circle btn-xl" onClick="document.getElementById('hoursSelection').value =2">2</button>
            <button type="button" class="btn btn-info btn-circle btn-xl" onClick="document.getElementById('hoursSelection').value =3">3</button>
            <button type="button" class="btn btn-info btn-circle btn-xl" onClick="document.getElementById('hoursSelection').value =4">4</button>
            
            <input class="form-control inputHours btn-circle btn-xl" id="hoursSelection" name="hours" placeholder="" type="number" required/>
          </div>
          </div>
         
         <div class="form-group ">
          <div class="input-group">
            <!-- Date Worked  -->
            <a href="#" role="button" id="yesterday"class="btn btn-warning btn-filter">Yesterday</a>
            <a href="#" role="button" id="today" class="btn btn-success btn-filter">Today </a>
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input class="form-control inputDate" id="date" name="dateWorked" placeholder="" type="text" required/>
          </div>
         </div>

         <div class="form-group ">
            <!-- Venue  -->
            @foreach($venues as $venue)
              <a href="#" role="button" id="venue_{{ $venue->id }}" class="btn btn-default" onClick="document.getElementById('venue').value ={{ $venue->id }}">
              <i class="fas fa-home fa-1x"></i>  
              {{ $venue->name }}</a>
            @endforeach
            <input type="hidden" id="venue" name="venue" placeholder="" type="number" required/>
         </div>

         <div class="form-group ">
          <!-- Description - Not Required -->
          <textarea class="form-control smart" id="description" name="description" placeholder="Description" type="text"/></textarea>
         </div>
         <div class="form-group">
           <div class="center_div">
            <input type="hidden" name="action" value="add_Hours_Form">
            <!-- <button class="btn btn-warning " name="submit" type="reset" > Reset</button> -->
            <button class="btn btn-info btn-lg" name="submit" type="submit" >
              Submit
            </button>
          </div>
         </div>
        </form>
       </div>
      </div>
     </div>
    </div>

    
@endsection

@section('footer')

<script>
//Setting Date Input to Today or Yesterdays date
window.onload = function () {
    var myClass = document.querySelector("#today")
        .onclick = function () {

          var d = new Date();
          var datestring = d.getFullYear()  + "-" + (d.getMonth()+1) + "-" + d.getDate();

          document.getElementById("date").value = datestring;
        return false;
    }
    var myClass2 = document.querySelector("#yesterday")
        .onclick = function () {
       
          var d = new Date();
          d.setDate(d.getDate()-1);
          var datestring = d.getFullYear()  + "-" + (d.getMonth()+1) + "-" + d.getDate();

          document.getElementById("date").value = datestring;
        return false;
    }
}
</script>
<script>
    $(document).ready(function(){
      //Show Calendar datepicker
        var date_input=$('input[name="dateWorked"]'); //our date input has the ID "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy-mm-dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
            todayBtn: false,
        })
    })
  </script>
  @endsection
