<html>
<head>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('bootstrap/sheet.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/bootstrap.min.css') }}" rel="stylesheet" id="bootstrap-css">
    <script src="{{ asset('bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bootstrap/jquery-1.11.1.min.js') }}"></script>
    <!------ Include the above in your HEAD tag ---------->

    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png') }}">
</head>

<body>
<div class="container">
    <h1 class="welcome text-center">{{ config('app.name', 'Laravel') }}<br></h1>

    <div class="card card-container">
        <h2 class='login_title text-center'><img src="{{ asset('assets/img/logo.png') }}" height="50px"></h2>
        <hr>

        <form class="form-signin" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <span id="reauth-email" class="reauth-email"></span>

            <div class="form-group">
                <input id="inputEmail" type="email" class="form-control" name="email" placeholder="Email"
                       value="{{ old('email') }}" required autofocus>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <input id="inputPassword" type="password" class="form-control" name="password" placeholder="Password"
                       required>

                @if ($errors->has('email'))
                    <span class="help-block" style="color: red">
                        {{ $errors->first('email') }}
                    </span>
                @endif

                @if ($errors->has('password'))
                    <span class="help-block" style="color: red">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>


            {{--<div id="remember" class="checkbox">--}}
                {{--<label>--}}
                    {{--<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me--}}
                {{--</label>--}}
            {{--</div>--}}

            <button class="btn btn-lg btn-primary" type="submit">Sign in</button>

        </form>
        <a class="btn btn-link" href="{{ route('password.request') }}">
            Forgot Your Password?
        </a>
    </div>
</div>
</body>
</html>
