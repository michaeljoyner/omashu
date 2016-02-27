@extends('admin.base')

@section('content')
    <div class="conatiner">
        <h1>{{ $rule->name }} shipping</h1>
        <hr/>
        <section class="rule-edit-section">
            {!! Form::model($rule, ['url' => '/admin/shippingrules/'.$rule->id, 'class' => 'form-horizontal omashu-form narrow']) !!}
            <div class="form-group">
                <label for="rate">Rate: </label>
                {!! Form::text('rate', null, ['class' => "form-control"]) !!}
            </div>
            <div class="form-group">
                <label for="free_above">Free above: </label>
                {!! Form::text('free_above', null, ['class' => "form-control"]) !!}
            </div>
            <div class="form-group">
                <button type="submit" class="btn omashu-btn">Set Rates</button>
            </div>
            {!! Form::close() !!}
        </section>
    </div>
@endsection