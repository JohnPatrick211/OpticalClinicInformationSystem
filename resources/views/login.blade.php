<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://use.fontawesome.com/releases/v5.15.2/js/all.js" data-auto-replace-svg="nest"></script>
    <link rel="stylesheet" href="/css/style2.css">
    <title>Login-Page</title>
</head>
<body>
    <!--<div class="overlay">-->
    <img class="BGG" src="../images/header-bg.jpg">
    <!--</div>-->
    <div class="container">
        <div class="img">
        </div>
        <div class="login-container">
        <form action="check" method="post">
            <img class="avatar" src="../img/initial_logo.png">
            <h4>Sign In</h4>
            @csrf
            <div class="input-div one ">
                <div class="i">
                    <i class="fas fa-user"></i>
                </div>
                <div>
                    <h5>Username</h5>
                    <input class="input"type="text" name="username">
                </div>
            </div>
            <span class="text-danger">@error('username') {{$message}} @enderror</span>
            <div class="input-div two">
                <div class="i">
                    <i class="fas fa-lock"></i>
                </div>
                <div>
                    <h5>Password</h5>
                    <input class="input "type="password" name="password">
                </div>
            </div>
            <span class="text-danger">@error('password') {{$message}} @enderror</span>
            <span class="text-danger">@error('fail') {{$message}} @enderror</span>
            @if(Session::get('fail'))
            {{Session::get('fail')}}
            @endif
            @if(Session::get('success'))
            {{Session::get('success')}}
            @endif
            <input type="submit" class="btn" value="Login" name="login">

            <a class="signup-link" href="register">Don't have an account? <span style="color:#30377A;">Sign up</span></a>
        </form>
    </div>
</div>
    <script type="text/javascript" src="../js/login.js"></script>
</body>
</html>
