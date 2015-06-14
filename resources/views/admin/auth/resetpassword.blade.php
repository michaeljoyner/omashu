@extends('admin.base')

@section('content')
    <div class="container">
        <h1>Reset Your Password</h1>

        <div class="row">
            <div class="col-md-offset-4 col-md-4">
                <p>Reset the password for user {{ Auth::user()->name }}</p>
                @include('admin.partials.errors')
                {!! Form::open(['class' => 'form-horizontal omashu-form']) !!}
                <div class="form-group">
                    <label for="current_password">Current Password: </label>
                    {!! Form::password('current_password', ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <label for="new_password">New Password: </label>
                    {!! Form::password('new_password', ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <label for="new_password">Confirm New Password: </label>
                    {!! Form::password('new_password_confirmation', ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <div>
                        <button class="btn omashu-btn" type="submit">Reset Password</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection