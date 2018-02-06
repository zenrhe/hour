@extends('layouts.master')

@section('content')

<h2>Add a Venue</h2>
<!-- HTML Form (wrapped in a .bootstrap-iso div) -->
<div class="bootstrap-iso">
     <div class="container-fluid">
      <div class="row">
       <div class="col-md-6 col-sm-6 col-xs-12">

      @if(count($errors))
       @include('layouts.errors')
      @endif

        <form method="POST" action="/venues">
        <!--<form method="post" action="view-user"> -->
         <div class="form-group ">
         {{ csrf_field() }}

          <label class="control-label" for="name">
           Name </label>
         <input class="form-control" type="text" id="name" name="name">
           
         </div>
         <div class="form-group ">
         {{ csrf_field() }}
          <label class="control-label" for="description">
           Description </label>
          <textarea class="form-control" id="description" name="description" type="text"/></textarea>
         </div>
         <div class="form-group">
          <div>
            <input type="hidden" name="action" value="add_Venue_Form">

            <button class="btn btn-primary " name="submit" type="submit" >
              Add
            </button>
          </div>
         </div>
        </form>
       </div>
      </div>
     </div>
    </div>

@endsection

