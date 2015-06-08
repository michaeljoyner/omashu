{!! Form::model($product, ['url' => $formAction]) !!}
<div class="form-group">
    <label for="name">Product Name</label>
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="quantifier">Quantifier</label>
    {!! Form::text('quantifier', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="description">Description</label>
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="is_available">Available
        {!! Form::checkbox('is_available', null, $product->is_available) !!}
    </label>
</div>
<div class="form-group">
    <div>
        <button type="submit">{{ $submitText }}</button>
    </div>
</div>
{!! Form::close() !!}