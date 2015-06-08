{!! Form::model($category, ['url' => $formAction]) !!}
<div class="form-group">
    <label for="name">Category Name: </label>
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="name">Description: </label>
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <div>
        <button type="submit">{{ $submitText }}</button>
    </div>
</div>
{!! Form::close() !!}