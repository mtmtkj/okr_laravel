<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Stal') }}</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
      window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
      ]); ?>
    </script>
  </head>
  <body>
    <div id="app">
      <header>
        <div class="navbar-fixed">
          <nav class="nav-wrapper">
            <div class="container">
              <!-- Branding Image -->
              <a class="brand-logo" href="{{ url('/home') }}">
                {{ config('app.name', 'Stal') }}
              </a>

              <!-- Right Side Of Navbar -->
              <ul class="right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                  <li><a href="{{ url('/login') }}">Login</a></li>
                  <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                  <li>
                    <a href="#" class="dropdown-button" data-activates="dropdown1">
                      {{ Auth::user()->name }} <i class="material-icons right">arrow_drop_down</i>
                    </a>
                  </li>
                @endif
              </ul>
            </div>
          </nav>
          <ul class="dropdown-content" id="dropdown1">
            <li><a href="{{ route('settings.edit') }}">Settings</a></li>
            <li>
              <a href="{{ url('/logout') }}"
                 onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                Logout
              </a>

              <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
              </form>
            </li>
          </ul>
        </div>
      @include('partials.guide')
      </header>
      <main>
        @yield('content')
      </main>
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script>
        $(document).ready(function () {
            $(".dropdown-button").dropdown();
        });
    </script>
    @stack('script')
  </body>
</html>
