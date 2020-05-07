<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.links')
</head>
<body style="background-color: hsla(140, 100%, 15%, 0.1);">
    <div id="app" style="font-family:  Geneva, Verdana, sans-serif">
        <nav class="navbar  navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="/images/icon1.png" width="35" height="30" class="d-inline-block align-top" alt="">
                    Plants at Hands 
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" 
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
                aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                        <li class="nav-item ml-4">
                            <form class="form-inline " action="{!! route('login') !!}" method="get">
                              <div class="input-group ">
                                <input type="text" class="form-control" name="search" placeholder="Search Products" aria-label="search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                  <button class="btn btn-outline-secondary" type="button"><i class="fa fa-search"></i></button>
                                </div>
                              </div>
                  
                            </form>
                          </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        
                        <!-- Authentication Links -->
                        @guest
                            
                            <a class="nav-item nav-link" href="{{ route('registerseller') }}">
                                <button type="button" class="btn btn-outline-danger">{{ __('Open a Seller Account') }}</button>
                            </a>
                            <a class="nav-item nav-link " href="{{ route('login') }}">
                                <button type="button" class="btn btn-outline-success">{{ __('Login') }}</button>
                            </a>
                            @if (Route::has('register'))
                                <a class="nav-item nav-link" href="{{ route('register') }}">
                                    <button type="button" class="btn btn-outline-success">{{ __('SignUp') }}</button>
                                </a>
                            @endif
                        @else

                            @if(Auth::user()->type=='seller')
                                <li>
                                    <a class="nav-item nav-link" href="{{ route('customer_orders') }}">
                                        <button type="button" class="btn btn-warning">{{ __('Manage Orders') }}</button>
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-item nav-link" href="{{ route('products.index') }}">
                                        <button type="button" class="btn btn-warning">{{ __('My Products') }}</button>
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-item nav-link" href="{{ route('products.create') }}">
                                        <button type="button" class="btn btn-warning">{{ __('Upload Product') }}</button>
                                    </a>
                                </li>

                            @endif

                        <li>
                            <a class="nav-item nav-link" href="{{ route('my_orders') }}">
                                <button type="button" class="btn btn-success">{{ __('My Orders') }}</button>
                            </a>
                        </li>
                        
                          <li>
                            <a class="nav-item nav-link" href="{{ route('mycart') }}">
                  
                              <button class="btn btn-danger">
                                <span class="">Cart</span>
                                <span class="badge badge-pill badge-warning"id="totalItems">
                                  {{Auth::user()->cartProducts->count()}}
                                </span>
                              </button>
                  
                            </a>
                          </li>
                  
                  
                            
                            <li class="nav-item dropdown">
                                <button class=" btn btn-outline-secondary dropdown-toggle mt-2" type="button" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-user"></i>
                                    @if(Auth::user()->type=='general')
                                        {{ Auth::user()->general->name }}
                                    @else 
                                        {{ Auth::user()->seller->name }}
                                    <span class="caret"></span>
                                    @endif
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
