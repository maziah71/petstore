<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{url('/products')}}">Kedai Haiwan Maziah</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">

        
        @auth
          
          <a class="navbar-brand navbar-right"
             href="{{ route('logout') }}"
             onclick="event.preventDefault();
             document.getElementById('logout-form').submit();">
             Logout</a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
          </form>

          <a class="navbar-brand navbar-right">Welcome back, {{Auth::user()->name}}</a>

          @else
          <form class="navbar-form navbar-right" role="form" method="POST" action="{{route('login')}}">
            {{csrf_field()}}
            <div class="form-group">
              <input name=email type="text" placeholder="Email" class="form-control">
            </div>
            <div class="form-group">
              <input name="password" type="password" placeholder="Password" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Sign in</button>
          </form>
        @endauth
        
      </div>
    </nav>