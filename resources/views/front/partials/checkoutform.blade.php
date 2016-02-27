{!! Form::open(['url' => '/checkout', 'class' => 'om-form checkout-form']) !!}
<div class="form-group">
    <label for="name">您的尊姓大名 / Name: </label>
    {!! Form::text('name', null, ['class' => "form-control", 'required']) !!}
</div>
<div class="form-group">
    <label for="email">您的電子信箱 / Email: </label>
    {!! Form::email('email', null, ['class' => 'form-control', 'required']) !!}
</div>
<div class="form-group">
    <label for="phone">您的聯繫方式 / Phone number(s): </label>
    {!! Form::text('phone', null, ['class' => "form-control", 'required']) !!}
</div>
<div class="form-group">
    <label for="address">您的寄送地址 / Delivery Address:</label>
    {!! Form::textarea('address', null, ['class' => 'form-control', 'required']) !!}
</div>
<div class="form-group">
    <label for="customer_query">您的叮嚀備註 / Additional comments: </label>
    {!! Form::textarea('customer_query', null, ['class' => 'form-control']) !!}
</div>
<div class="instruction-panel">
    <span class="instruction-number">3.</span>
    <span class="instruction-text">送出訂單 / Submit your order.</span>
    <p class="instruction-detail">當訂單送出後，您將會收到我們的確認email，與付款明細。ㄧ收到您的匯款，會立刻為您安排出貨。</p>
    <p class="instruction-detail">When you submit your order, you will receive an email detailing the payment process. Once we receive your payment we will immediately ship your order.</p>
</div>
<div class="form-group">
    <button type="submit" class="btn om-btn">送出訂單 / Place order</button>
</div>
{!! Form::close() !!}