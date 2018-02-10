<div class='alert alert-danger'>
      <ul>
        @foreach($errors->all() as $error)
          <li> {{$error}} </li>
        @endforeach
      </ul>
    <p>{{ session()->get('error') }}</p>
      
    </div>