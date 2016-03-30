<!doctype html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    @section('title')
    <title>Omashu Imports</title>
    @show
    <meta id="x-token" property="CSRF-token" content="{{ Session::token() }}"/>
    @yield('head')
    @yield('seotags')
    <!-- Latest compiled and minified CSS for bootstrap-->
    <link rel="stylesheet" href="{{ elixir("css/app.css") }}">
    <link href='https://fonts.googleapis.com/css?family=Slabo+13px|Open+Sans:400,300' rel='stylesheet' type='text/css'>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
@include('front.partials.secondarynav')
@yield('content')
<div class="back-to-top-btn">top</div>
<script src="{{ elixir('js/front.js') }}"></script>
<script src="/js/frontb.js"></script>
@yield('bodyscripts')
<script>
    (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
        e=o.createElement(i);r=o.getElementsByTagName(i)[0];
        e.src='https://www.google-analytics.com/analytics.js';
        r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
    ga('create','UA-51468211-5','auto');ga('send','pageview');
</script>
</body>
</html>