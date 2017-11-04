<!DOCTYPE html>
<html lang="en" class="layout-pf layout-pf-fixed transitions">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Stal') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
      window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
      ]); ?>
    </script>
  </head>
  <body class="cards-pf">
    <div id="app">
      <header>
        <nav class="navbar navbar-pf-vertical">
          <div class="container">
            <div class="navbar-header">

              <!-- Collapsed Hamburger -->
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>

              <!-- Branding Image -->
              <a class="navbar-brand" href="{{ url('/home') }}">
                {{ config('app.name', 'Stal') }}
              </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
              <!-- Left Side Of Navbar -->
              <ul class="nav navbar-nav">
                &nbsp;
              </ul>

              <!-- Right Side Of Navbar -->
              <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                  <li><a href="{{ url('/login') }}">Login</a></li>
                  <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                      {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
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
                  </li>
                @endif
              </ul>
            </div>
          </div>
        </nav>
      </header>
      <div class="nav-pf-vertical nav-pf-vertical-with-sub-menus nav-pf-persistent-secondary">
        <ul class="list-group">
          <li class="list-group-item">
            <a href="/home">
              <span class="fa fa-bar-chart" data-toggle="tooltip" title="" data-original-title="Dashboard"></span>
              <span class="list-group-item-value">Dashboard</span>
            </a>
          </li>
          <li class="list-group-item">
            <a href="#">
              <span class="fa fa-building-o" data-toggle="tooltip" title="" data-original-title="Adipscing"></span>
              <span class="list-group-item-value">Organization</span>
            </a>
          </li>
          <li class="list-group-item">
            <a href="#">
              <span class="fa fa-users" data-toggle="tooltip" title="" data-original-title="Lorem"></span>
              <span class="list-group-item-value">Members</span>
            </a>
          </li>
        </ul>
      </div>
      <main>
        <div class="container-fluid container-cards-pf container-pf-nav-pf-vertical nav-pf-persistent-secondary hidden-icons-pf">
          @include('partials.guide')
          @yield('content')
        </div>
      </main>
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
    @stack('script')
  </body>
</html>
