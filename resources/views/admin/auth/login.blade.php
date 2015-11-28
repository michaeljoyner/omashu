<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Omashu Login</title>
    <link href='http://fonts.googleapis.com/css?family=Slabo+13px|Open+Sans:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ elixir("css/bapp.css") }}">
</head>
<body>
    <div class="login-form-container">
        @include('admin.partials.errors')
        {!! Form::open(['class' => 'form-horizontal omashu-form']) !!}
        <h1 class="login-title">Please Login</h1>
        <img src="/images/website_logo.png" alt="">
        <div class="form-group">
            <label for="email">Email: </label>
            {!! Form::email('email', Input::old('email'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            <label for="password">Password: </label>
            {!! Form::password('password', ['class' => 'form-control']) !!}
        </div>
        <div>
            <label for="remember_me"> Remember me
                {!! Form::checkbox('remember_me', 1, false, ['id' => 'remember_me']) !!}
            </label>
        </div>
        <div class="form-group">
            <div>
                <button class="btn omashu-btn" type="submit">Login</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</body>
</html>
