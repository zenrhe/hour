@extends('layouts.master')

@section('content')

<h2>Log for <strong>{{$user->first_name}} </strong></h2>
<!-- HTML Form (wrapped in a .bootstrap-iso div) -->
<div class="bootstrap-iso">
     <div class="container-fluid">
      <div class="row">
       <div class="col-md-6 col-sm-6 col-xs-12">

      @if(count($errors))
       @include('layouts.errors')
      @endif


        <form method="POST" action="/logs">
        <!--<form method="post" action="view-user"> -->
         <div class="form-group ">
         {{ csrf_field() }}
         
         <input type="hidden" name="user_id" value="{{$user->id}}">

         <label class="control-label requiredField" for="hoursSelection">
           Hours
          </label>

          <select class="select form-control" id="hoursSelection" name="hours" required>
            <!-- TODO Make Option Loop -->
           <option value=""></option>
           <option value="1"> 1 </option>
           <option value="2"> 2 </option>
           <option value="3"> 3 </option>
           <option value="4"> 4 </option>
           <option value="5"> 5 </option>
           <option value="6"> 6 </option>
           <option value="7"> 7 </option>
           <option value="8"> 8 </option>
           <option value="9"> 9 </option>
           <option value="10"> 10 </option>
          </select>
         </div>
         <div class="form-group ">
          <label class="control-label requiredField" for="date" required> Date  </label>
          <div class="input-group">
           <div class="input-group-addon">
            <i class="fa fa-calendar">
            </i>
           </div>
           <input class="form-control" id="date" name="dateWorked" placeholder="" type="text" />
          </div>
         </div>
         <div class="form-group ">
          <label class="control-label requiredField" for="venue"> Venue </label>
          <select class="select form-control" id="venue" name="venue_id" required>
            <option value=""></option>

            @foreach($venues as $venue)
                <option value='{{ $venue->id }}'>{{ $venue->name }}</option>
            @endforeach
           <!-- <option value="Other">  Other </option> -->
          </select>
         </div>
         <div class="form-group ">
          <label class="control-label" for="description">
           Description </label>
          <textarea class="form-control" id="description" name="description" type="text"/></textarea>
         </div>
         <div class="form-group">
          <div>
            <input type="hidden" name="action" value="add_Hours_Form">

            <button class="btn btn-primary " name="submit" type="submit" >
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
    $(document).ready(function(){
      //Show Calendar datepicker
        var date_input=$('input[name="dateWorked"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy-mm-dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
            todayBtn: true,
        })
    })
  </script>
  @endsection
