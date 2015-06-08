@extends('admin.base')

@section('content')
    <h1>Reset Your Password</h1>
    <p>Reset the password for user {{ Auth::user()->name }}</p>
    @include('admin.partials.errors')
    {!! Form::open() !!}
    <div class="form-group">
        <label for="current_password">Current Password: </label>
        {!! Form::password('current_password') !!}
    </div>
    <div class="form-group">
        <label for="new_password">New Password: </label>
        {!! Form::password('new_password') !!}
    </div>
    <div class="form-group">
        <label for="new_password">Confirm New Password: </label>
        {!! Form::password('new_password_confirmation') !!}
    </div>
    <div class="form-group">
        <div>
            <button type="submit">Reset Password</button>
        </div>
    </div>
    {!! Form::close() !!}
@endsection