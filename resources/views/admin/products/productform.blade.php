{!! Form::model($product, ['url' => $formAction, 'class' => 'form-horizontal omashu-form', 'id' => $formId]) !!}
<div class="form-group">
    <label for="name">Product Name</label>
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="zh_name">Chinese Name</label>
    {!! Form::text('zh_name', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="quantifier">Quantifier</label>
    {!! Form::text('quantifier', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="zh_quantifier">Chinese Quantifier</label>
    {!! Form::text('zh_quantifier', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="description">Description</label>
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="is_available">Available
        {!! Form::checkbox('is_available', 1, $product->is_available == 1) !!}
    </label>
</div>
<div class="form-group">
    <div>
        <button class="btn omashu-btn" type="submit">{{ $submitText }}</button>
    </div>
</div>
{!! Form::close() !!}