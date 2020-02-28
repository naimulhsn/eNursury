<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.links')
</head>
<body style="background-color: hsla(140, 100%, 15%, 0.1);">
    <div id="app">
        <nav class="navbar  navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <a class="navbar-brand" href="{{ url('/') }}">
                    <b>Plants at Hand</b>
                </a>
                

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link text-" href="{{ route('login') }}">
                                    <button type="button" class="btn btn-outline-secondary">{{ __('Login') }}</button>
                                </a>
                            </li>
                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">
                                    <button type="button" class="btn btn-outline-secondary">{{ __('Register') }}</button>
                                </a>
                            </li>
                            @endif
                        @else
                           

                            <li class="nav-item dropdown">
                                
                                <button class=" btn btn-outline-secondary dropdown-toggle mt-2" type="button" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ Auth::user()->name }} 
                                    <span class="caret"></span>
                                </button>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href={{route('user_profile',Auth::user()->id)}}>
                                            Profile
                                        </a>
    
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
    
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
    
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href={{route('about')}}>
                                            About Developer
                                        </a>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>





        
        <main class="py-4 " >
            @yield('content')
        </main>
    </div>
</body>
</html>
