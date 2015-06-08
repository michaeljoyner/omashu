{!! Form::open(['url' => '/admin/register']) !!}
<div class="form-group">
    <label for="name">Name:</label>
    {!! Form::text('name', null, ['placeholder' => 'Your Name']) !!}
</div>
<div class="form-group">
    <label for="email">Email address:</label>
    {!! Form::email('email', null, ['placeholder' => 'Your Email address']) !!}
</div>
<div class="form-group">
    <label for="password">Password:</label>
    {!! Form::password('password') !!}
</div>
<div class="form-group">
    <label for="password_confirmation">Confirm Password:</label>
    {!! Form::password('password_confirmation') !!}
</div>
<div class="form-group">
    <div>
        <button type="submit">Register</button>
    </div>
</div>
{!! Form::close() !!}