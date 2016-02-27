@extends('front.base')

@section('content')
    @include('front.partials.nav', ['extraClassName' => ' inverse'])
    <header class="main-page-header">
        <h1 class="page-title"><span><span class="zh-page-title">購物車</span>Checkout</span></h1>

    </header>
    <section class="order-summary">
        <div class="instruction-panel">
            <span class="instruction-number">1.</span>
            <span class="instruction-text">修改訂單 / Review your order.</span>
        </div>
        <table class="pre-invoice">
            <thead>
                <tr class="invoice-heading">
                    <td>#</td>
                    <td>Item</td>
                    <td>Qty</td>
                    <td>Price</td>
                </tr>
            </thead>
            <tbody>
                @foreach($invoice->items as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>NT${{ $item['quantity'] * $item['unit_price'] }}</td>
                    </tr>
                @endforeach
                    <tr><td class="invoice-sum" colspan="4">金額 / Subtotal: <span>NT${{ $invoice->subtotal }}</span></td></tr>
                    <tr><td class="invoice-sum topless" colspan="4">運費 / Shipping: <span>NT${{ $invoice->shipping }}</span></td></tr>
                    <tr><td class="invoice-sum topless" colspan="4">總金額 / Total: <span>NT${{ $invoice->total() }}</span></td></tr>
            </tbody>
        </table>
    </section>
    <section class="customer-form-container">
        <div class="instruction-panel">
            <span class="instruction-number">2.</span>
            <span class="instruction-text">填寫資料 / Fill out your details.</span>
        </div>
        @include('front.partials.checkoutform')
    </section>
    @include('front.partials.footer')
@endsection