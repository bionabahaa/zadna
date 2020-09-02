<!DOCTYPE html>
<html lang="arabic" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <title>login</title>

    <link rel="stylesheet" href="{{ asset('public/styles/backEnd') }}/dist/css/zadna-str.css">

    <!-- Styles -->
    <link href="{{ asset('public/styles/backEnd') }}/dist/css/bootstrap4-rtl.css" rel="stylesheet">
    <!-- zadna structure style css -->
    <link rel="stylesheet" href="{{ asset('public/styles/backEnd') }}/dist/css/zadna-str.css">
    <link rel="stylesheet" href="{{ asset('public/styles/backEnd') }}/dist/css/generalSet.css">
    <link rel="stylesheet" href="{{ asset('public/styles/backEnd') }}/dist/css/login.css">
    <link rel="stylesheet" href="{{ asset('public/styles/backEnd') }}/dist/css/font-awesome.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>



</head>

<body>
<div class="login-box">
        <div class="login-logo">
            <img src="{{ asset('public/styles/backEnd') }}/dist/imgs/logo.png">
        </div>
       
            <form method="POST" action="{{ url('/login') }}"  id="LoginForm" style="margin-top: 20px;">
                <div class="login-box-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                @csrf
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" id="username" name="username" required placeholder='&#xf007; اسم المستخدم'>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" id="pwd" required name="password" placeholder='&#xf023; الرقم السري'>
                    <img src="{{ asset('public/styles/backEnd') }}/dist/imgs/Oyk1g.png" id="EYE" onclick="show()">
                </div>

                <br>
                <div class="row">
                    <div class="col-xs-12" style="margin: 0 auto ;width: 100%">
                        <button type="submit" class="btn  btn-block flat">تسجيل الدخول</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="login-pic">
            <img src="{{ asset('public/styles/backEnd') }}/dist/imgs/login-1.png">
        </div>
    </div>
    <script src="{{ asset('public/styles/backEnd') }}/dist/js/script.js"></script>
    <script src="{{ asset('public') }}/js/backEnd/login.js"></script>
</body>

</html>