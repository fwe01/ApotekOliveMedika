<!DOCTYPE html>
<html>
<head>
    <title>User Login Form</title>
    @include('auth.user.style')
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<img class="wave" src="{{asset('img/wave.png')}}">
<div class="container">
    <div class="img">
        <img src="{{asset('img/bg.svg')}}">
    </div>
    <div class="login-content">
        <form method="post" action="{{route('auth.user.login')}}" autocomplete="off">
            @csrf
            <img src="{{asset('img/profile_pic.svg')}}">
            <h2 class="title">Welcome</h2>
            <div class="input-div one">
                <div class="i">
                    <i class="fas fa-user"></i>
                </div>
                <div class="div">
                    <input type="text" class="input" name="username" placeholder="Username">
                </div>
            </div>
            <div class="input-div pass">
                <div class="i">
                    <i class="fas fa-lock"></i>
                </div>
                <div class="div">
                    <input type="password" class="input" name="password" placeholder="Password">
                </div>
            </div>
            <a href="#">Forgot Password?</a>
            <input type="submit" class="btn" value="Login">
        </form>
    </div>
</div>
<script type="text/javascript" src="js/main.js"></script>
</body>
</html>
