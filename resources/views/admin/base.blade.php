<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Omashu Admin</title>
    @yield('head')
    <!-- Latest compiled and minified CSS for bootstrap-->
    <link rel="stylesheet" href="{{ elixir("css/bapp.css") }}">
    <link href='http://fonts.googleapis.com/css?family=Slabo+13px|Open+Sans:400,300' rel='stylesheet' type='text/css'>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div class="main-navbar">
        @include('admin.partials.navbar')
    </div>
    <div class="main-content">
        @yield('content')
    </div>
    @include('flash::message')

    <script src="{{ elixir("js/app.js") }}"></script>
    <script>
        $('.alert-info').delay(2000).hide('slow');
    </script>
    @yield('bodyscripts')
</body>
</html>