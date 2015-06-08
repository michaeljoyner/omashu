{!! Form::model($brand, ['url' => $formAction]) !!}
<div class="form-group">
    <label for="name">Brand Name:</label>
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="tagline">Brief Description:</label>
    {!! Form::text('tagline', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="description">Full Description:</label>
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="website">Brand Website:</label>
    {!! Form::text('website', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <div>
        <button type="submit">{{ $submitText }}</button>
    </div>
</div>
{!! Form::close() !!}