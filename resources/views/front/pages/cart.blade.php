@extends('front.base')

@section('seotags')
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
@endsection

@section('content')
    @include('front.partials.nav', ['extraClassName' => ' inverse'])
    <header class="main-page-header">
        <h1 class="page-title"><span><span class="zh-page-title">購物車</span>Your cart</span></h1>
        <section class="shipping-banner">
            <p class="shipping-zh">訂購金額超過(含){{ $freeShippingPrice }}元整即享免運費</p>
            <p class="shipping-en">Free shipping for orders over NT${{ $freeShippingPrice }}</p>
        </section>
    </header>
    <section id="cart-list-container">
        <ul class="cart-list">
            <li v-for="item in items" class="cart-list-item">
                <cartitem :rowid="item.rowid"
                          :description="item.name"
                          :id="item.id"
                          :quantity="item.qty"
                          :price="item.price"
                          :thumb="item.options.image_src"
                ></cartitem>
                <div class="remove-btn" v-on:click="removeItem(item)">
                    @include('svg.trash')
                </div>
            </li>
            <p class="empty-cart-message" v-show="! items.length">You have no items in your cart yet. Maybe one of these <a href="/products">products</a> would interest you.</p>
        </ul>
        <div class="subtotal-and-shipping">
            <p class="subtotal">金額 / Subtotal: NT$@{{ subtotal }}</p>
            <p class="shipping-fee">運費 / Shipping fee: NT$@{{ shipping }}</p>
            <p class="total">總金額 / Total: NT$@{{ total }}</p>
            <a href="/checkout">
                <div class="om-btn to-checkout-btn">我要結帳 / Checkout</div>
            </a>
        </div>

    </section>
    @include('front.partials.footer')
@endsection

@section('bodyscripts')
    <script>
        var cart = new Vue(omashuApp.vueConstructorObjects.cart);
    </script>
@endsection