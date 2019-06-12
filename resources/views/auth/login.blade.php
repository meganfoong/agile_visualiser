<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="" href="av2.png">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login - Agile Visualiser</title>

    <!-- Bootstrap core CSS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/floating-labels.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Gothic+A1" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <form class="form-signin" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="text-center mb-4">
            <img class="mb-4" src="assets/av_logo.png" width="250">
        </div>

        <div class="form-label-group">
            <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email" autofocus placeholder="Email">
            <label for="email">Email</label>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-label-group">
            <input type="password" id="inputPassword" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"  placeholder="Password">
            <label for="inputPassword">Password</label>
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-auto text-center">
            <button class="btn btn-outline-danger" type="submit">{{ __('Login') }}</button>
            @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
            @endif

            <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('Validate account') }}
            </a>

            <p class="mt-5 mb-3 text-muted text-center"> 2019-Present</p>
        </div>
    </form>
</body>

</html>
