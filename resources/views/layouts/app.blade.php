
<!DOCTYPE html>
    <html >
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <head>
        <title>تقارير</title>
        @include('layouts/header')
        @section('head_part')
        @show
    </head>
    <body class="hold-transition skin-red sidebar-mini">
         @yield('content')

         @include('layouts/footer')
         @section('footer_part')
         @show
    </body>

</html>
