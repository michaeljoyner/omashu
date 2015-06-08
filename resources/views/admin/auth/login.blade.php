@extends('admin.base')

@section('content')
    <h1>Please Login</h1>
    @include('admin.partials.errors')
    {!! Form::open() !!}
    <div class="form-group">
        <label for="email">Email: </label>
        {!! Form::email('email', Input::old('email')) !!}
    </div>
    <div class="form-group">
        <label for="password">Password: </label>
        {!! Form::password('password') !!}
    </div>
    <div class="form-group">
        <div>
            <button type="submit">Login</button>
        </div>
    </div>
    {!! Form::close() !!}
@endsection