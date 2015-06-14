{!! Form::model($category, ['url' => $formAction, 'class' => 'omashu-form form-horizontal', 'id' => $formId]) !!}
<div class="form-group">
    <label for="name">Category Name: </label>
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="zh_name">Chinese Name: </label>
    {!! Form::text('zh_name', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="name">Description: </label>
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <div>
        <button class="btn omashu-btn" type="submit">{{ $submitText }}</button>
    </div>
</div>
{!! Form::close() !!}