{!! Form::model($stockist, ['url' => $formAction]) !!}
<div class="form-group">
    <label for="name">Stockist: </label>
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="address">Address: </label>
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="phone">Phone number: </label>
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="website">Website: </label>
    {!! Form::text('website', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <div>
        <button type="submit">{{ $submitText }}</button>
    </div>
</div>
{!! Form::close() !!}