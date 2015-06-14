{!! Form::open(['url' => '/admin/register', 'class' => 'form-horizontal omashu-form']) !!}
<div class="form-group">
    <label for="name">Name:</label>
    {!! Form::text('name', null, ['placeholder' => 'Your Name', 'class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="email">Email address:</label>
    {!! Form::email('email', null, ['placeholder' => 'Your Email address', 'class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="password">Password:</label>
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="password_confirmation">Confirm Password:</label>
    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <div>
        <button class="btn omashu-btn" type="submit">Register</button>
    </div>
</div>
{!! Form::close() !!}