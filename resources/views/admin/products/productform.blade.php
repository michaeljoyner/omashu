{!! Form::model($product, ['url' => $formAction, 'class' => 'form-horizontal omashu-form product-form', 'id' => $formId]) !!}
{{--<div class="row">--}}
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-6 fifty-fifty">
                <div class="form-group">
                    <label for="name">Product Name</label>
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <label for="quantifier">Quantifier</label>
                    {!! Form::text('quantifier', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-6 fifty-fifty">
                <div class="form-group">
                    <label for="zh_name">Chinese Name</label>
                    {!! Form::text('zh_name', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <label for="zh_quantifier">Chinese Quantifier</label>
                    {!! Form::text('zh_quantifier', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="price">Price: </label>
                    <div class="input-group">
                        <div class="input-group-addon">NT$</div>
                        {!! Form::text('price', null, ['class' => "form-control short"]) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="write_up">Product Write Up: </label>
                    {!! Form::textarea('write_up', null, ['class' => 'form-control', 'id' => 'writer']) !!}
                </div>
            </div>
        </div>
    </div>
{{--</div>--}}
<div class="form-group">
    <div>
        <button class="btn omashu-btn" type="submit">{{ $submitText }}</button>
    </div>
</div>
{!! Form::close() !!}