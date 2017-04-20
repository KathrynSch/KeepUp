<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>KEEP UP</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Rock+Salt" rel="stylesheet">


    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
 <body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
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
                    <a class="navbar-brand" href="{{ url('/') }}">KEEP UP</a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                   <!--  <ul class="nav navbar-nav">
                        &nbsp;
                    </ul> -->

                    <!-- Right Side Of Navbar -->
                    <!-- <ul class="nav navbar-nav navbar-right"> -->
                      <ul class="nav navbar-nav navbar-right">

                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        </ul>
                        @else
                         <!-- Si user authentifié -->
                            <!-- <div class="btn-group" role="group" aria-label="..."> -->
                            

                            <ul class="nav navbar-nav .navbar-toggler-left">

                            <!-- Barre de recherche -->
                            <form class="navbar-form navbar-left" role="search" method="POST" action="{{route('search')}}">
                            {{ csrf_field() }}
                              <div class="form-group">
                                <input type="text" class="form-control" name="content" placeholder="Search">
                              </div>
                              <button type="submit" class="btn btn-default">
                              <a> <img src="{{asset('images/loupe.png')}}" alt="love" height="20"/></a>
                              </button>
                            </form>

                           
                            <!-- BOUTON ACCUEIL -->
                            <li><a href="{{ route('login') }}">HOME</a></li>
                           <!--  <button type="button" class="btn btn-default">ACCUEIL</button> -->
                            <!-- BOUTON PROFIL -->
                            <li><a href="{{ route('about', ['id' => Auth::id()])}}">PROFILE</a></li>
                           <!--  <a type="button" class="btn btn-default" href="{{ route('about', ['id' => Auth::id()]) }}">PROFIL</a> -->
                            <!-- BOUTON LOGOUT -->
                            <li><a href="">FRIENDS</a></li>
                            <!-- </div> --> 
                        </ul>

                    <ul class="nav navbar-nav navbar-right">
                              <li><a href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">LOG OUT</a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        <!--  <a  class="btn btn-default" href=href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                               </ul> -->

                        @endif
                   


                 
                </div>
            </div>
        </nav>
    </div>
    @yield('content')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
