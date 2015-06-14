{!! Form::model($brand, ['url' => $formAction, 'class' => 'omashu-form form-horizontal', 'id' => $formId]) !!}
<div class="form-group">
    <label for="name">Brand Name:</label>
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="tagline">Brief Description:</label>
    {!! Form::text('tagline', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="zh_tagline">Brief Chinese Description:</label>
    {!! Form::text('zh_tagline', null, ['class' => 'form-control']) !!}
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
        <button class="btn omashu-btn" type="submit">{{ $submitText }}</button>
    </div>
</div>
{!! Form::close() !!}