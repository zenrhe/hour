<div class="nav_wrapper">
  <a href="{{ url('/') }}"class="navbar-brand">Volunteer Hours</a>
  <div class="navbar">

    @guest
      <a href="{{ route('login') }}">Login</a> 
      <a href="{{ route('register') }}">Register</a> 
      @else
        <!-- Show Add and View Buttons -->
        <a  href="/logs/create" class="btn btn-primary" role="button" >Add</a>
        <a  href="/users/{{ Auth::user()->id }}" class="btn btn-primary" role="button" >View</a>

        <!-- Link to User Profile -->
        <a href="/profile/{{ Auth::user()->id }}">
          <i class="fas fa-user"></i> {{ Auth::user()->first_name }}
        </a>

        <!-- Logout -->
        <a href="{{ route('logout') }}"
          onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a> 
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
        </form>
    @endguest
  </div>
</div>

