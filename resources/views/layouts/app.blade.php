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

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

    <!-- (Optional) Latest compiled and minified JavaScript translation files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/i18n/defaults-*.min.js"></script>
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

                <div class="collapse navbar-collapse" id="navbarNav">
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
                        
                        <li style="margin: auto">
                            {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('changePassword') }}"
                               onclick="event.preventDefault(); document.getElementById('changePassword-form').submit();">
                                <i class="material-icons">
                                    lock
                                </i>
                            </a>
                        </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="material-icons">
                                        power_settings_new
                                    </i>
                                </a>
                            </li>

                            <form id="changePassword-form" action="{{ route('changePassword') }}" method="GET" style="display: none;">
                                @csrf
                            </form>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>



                        @endguest
                    </ul>
                </div>

            </nav>
            <br>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    @yield('supervisorCrumbs')
                    @yield('studentCrumbs')
                </ol>
            </nav>

        </div>
    </div>

    @yield('content')

    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-11 col-xl-10">
                    <div class="page-header mb-4">
                        
                        <div class="media">
                            @yield('supervisorMedia')
                            @yield('projectMedia')
                            @yield('taskMedia')
                        </div>
                    </div>

                    @yield('supervisorNav')

                    @yield('projectNav')

                    @yield('taskNav')

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
                        <div class="tab-pane fade" id="nav-projects" role="tabpanel" aria-labelledby="nav-projects-tab">
                            <div class="tab-content">
                                @yield('project')
                            </div>
                        </div>


                        <!-- Students tab starts here -->
                        <div class="tab-pane fade" id="nav-students" role="tabpanel" aria-labelledby="nav-students-tab">
                            <div class="tab-content">
                                @yield('student')
                            </div>
                        </div>
                    </div>

                    <div class="tab-content" id="myTabContent">
                        <!-- Overview tab starts here -->
                        <div class="tab-pane fade show active" id="nav-dash" role="tabpanel"
                            aria-labelledby="nav-dash-tab">
                            <div class="tab-content">
                                @yield('dash')
                            </div>
                        </div>
                        
                        <!-- Overview tab starts here -->
                        <div class="tab-pane fade show" id="nav-overview" role="tabpanel"
                            aria-labelledby="nav-overview-tab">
                            <div class="tab-content">
                                @yield('overview')
                            </div>
                        </div>


                        <!-- Progress tab starts here -->
                        <div class="tab-pane fade" id="nav-progress" role="tabpanel" aria-labelledby="nav-progress-tab">
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

                    <div class="tab-content" id="myTabContent">
                        <br>
                        <!-- Dashboard tab starts here -->
                        <div class="tab-pane fade show active" id="nav-subtask" role="tabpanel"
                            aria-labelledby="nav-dashboard-tab">
                            <div class="tab-content">
                                @yield('subtask')
                            </div>
                        </div>

                        <!-- Project tab starts here -->
                        <div class="tab-pane fade" id="nav-subContribution" role="tabpanel" aria-labelledby="nav-subContribution-tab">
                            <div class="tab-content">
                                @yield('subContribution')
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
