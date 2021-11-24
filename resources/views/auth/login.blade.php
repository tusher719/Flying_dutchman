<!DOCTYPE html>
<html>
<head>
    <title>Animated Login Form</title>
    <link rel="stylesheet" type="text/css" href="{{asset('deshboardLogin')}}/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<img class="wave" src="{{asset('deshboardLogin')}}/img/wave.png">
<div class="container">
    <div class="img">
        <img src="{{asset('deshboardLogin')}}/img/bg.svg">
    </div>
    <div class="login-content">
        <form action="{{ route('login') }}" method="post">
            @csrf
            <img src="{{asset('deshboardLogin')}}/img/avatar.svg">
            <h2 class="title">Welcome</h2>
            <div class="input-div one">
                <div class="i">
                    <i class="fas fa-user"></i>
                </div>
                <div class="div">
                    <h5>Username</h5>
                    <input type="email" name="email" class="input">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="input-div pass">
                <div class="i">
                    <i class="fas fa-lock"></i>
                </div>
                <div class="div">
                    <h5>Password</h5>
                    <input type="password" name="password" class="input">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}">Forgot Password?</a>
            @endif
            <div>
                <a href="{{ route('register') }}">Create an Account</a>
            </div>
            <input type="submit" class="btn" value="Login">
        </form>
    </div>
</div>
<script type="text/javascript" src="{{asset('deshboardLogin')}}/js/main.js"></script>
</body>
</html>
