<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Gothic+A1" rel="stylesheet">

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" href="#">
                    <img src="{{ URL::to('/assets/av2.png') }}" width="30" height="" class="img" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                {{-- <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-item nav-link" href="javascript:void(0);"
                                onclick="$('.nav-tabs a[href=\'#nav-dashboard\']').click();">Dashboard</a>
                            <!-- <a class="nav-item nav-link" href="#nav-activity" data-toggle="tab">Activities <span class="sr-only">(current)</span></a> -->
                        </li>
                        <li class="nav-item">
                            <a class="nav-item nav-link" href="javascript:void(0);"
                                onclick="$('.nav-tabs a[href=\'#nav-projects\']').click();">Projects</a>
                        <li class="nav-item">
                            <a class="nav-item nav-link" href="javascript:void(0);"
                                onclick="$('.nav-tabs a[href=\'#nav-students\']').click();">Students</a>
                            <!-- <a class="nav-item nav-link" href="#nav-student" data-toggle="tab">Students</a> -->
                        </li>

                    </ul>
                </div> --}}

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                                         document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>

            </nav>
        </div>
        <br>
        @yield('content')
        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-11 col-xl-10">
                        <div class="page-header mb-4">
                            <div class="media">
                                <img alt="Image" src="pic/123.png" class="avatar avatar-lg mt-1" style="width:9%" />
                                <div class="media-body ml-3">
                                    <h1 class="mb-0">Rhys Tague</h1>
                                    <!-- <h1 class="mb-0"> Auth::user()->name </h1> -->
                                    <p class="lead">Supervisor</p>
                                </div>
                            </div>
                        </div>
                        
                        @yield('supervisorNav')

                        @yield('projectNav')

                        <div class="tab-content" id="myTabContent">
                            <br>
                            <!-- Dashboard tab starts here -->
                            <div class="tab-pane fade show active" id="nav-dashboard" role="tabpanel"
                                aria-labelledby="nav-dashboard-tab">
                                <div class="tab-content">
                                    @yield('dashboard')
                                </div>
                            </div>


                            <!-- Project tab starts here -->
                            <div class="tab-pane fade" id="nav-projects" role="tabpanel"
                                aria-labelledby="nav-projects-tab">
                                <div class="tab-content">
                                    @yield('project')
                                </div>
                            </div>


                            <!-- Students tab starts here -->
                            <div class="tab-pane fade" id="nav-students" role="tabpanel"
                                aria-labelledby="nav-students-tab">
                                <div class="tab-content">
                                    @yield('student')
                                </div>
                            </div>
                        </div>

                        <div class="tab-content" id="myTabContent">
                            <!-- Overview tab starts here -->
                            <div class="tab-pane fade show active" id="nav-overview" role="tabpanel"
                                aria-labelledby="nav-dashboard-tab">
                                <div class="tab-content">
                                    @yield('overview')
                                </div>
                            </div>


                            <!-- Progress tab starts here -->
                            <div class="tab-pane fade" id="nav-progress" role="tabpanel"
                                aria-labelledby="nav-progress-tab">
                                <div class="tab-content">
                                    @yield('progress')
                                </div>
                            </div>


                            <!-- Tasks tab starts here -->
                            <div class="tab-pane fade" id="nav-tasks" role="tabpanel" aria-labelledby="nav-tasks-tab">
                                <div class="tab-content">
                                    @yield('task')
                                </div>
                            </div>


                            <!-- Contribution tab starts here -->
                            <div class="tab-pane fade" id="nav-contribution" role="tabpanel"
                                aria-labelledby="nav-contribution-tab">
                                <div class="tab-content">
                                    @yield('contribution')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>

{{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
{{ config('app.name', 'Laravel') }}
</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
    <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <!-- Left Side Of Navbar -->
    <ul class="navbar-nav mr-auto">

    </ul>

    <!-- Right Side Of Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Authentication Links -->
        @guest
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        @if (Route::has('register'))
        <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
        </li>
        @endif
        @else
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
        @endguest
    </ul>
</div>
</div>
</nav> --}}
