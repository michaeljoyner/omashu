@extends('front.base')

@section('title')
    <title>{{ $product->zh_name }} | {{ $product->name }} |  Omashu Imports</title>
@endsection

@section('seotags')
    <meta name="description" content="{{ $product->description }}"/>
    @include('front.partials.ogmeta', [
        'og_url' => 'http://omashuimports.com/product/'.$product->slug,
        'og_title' => $product->name . ' | ' . $product->zh_name,
        'og_description' => $product->description
    ])
    <link rel="canonical" href="http://omashuimports.com/product/{{ $product->slug }}"/>
@endsection

@section('content')
    @include('front.partials.nav', ['extraClassName' => ' inverse'])
    <header class="product-page-header">
        <h1 class="product-page-title zhongwen">{{ $product->zh_name }}</h1>
        <h1 class="product-page-title yingwen">{{ $product->name }}</h1>
        <p class="product-quantifier">
            <span class="zhonwen">{{ $product->zh_quantifier }}</span> / <span class="yingwen">{{ $product->quantifier }}</span>
        </p>

    </header>
    <section id="product-container" data-product="{{ $product->id }}">
        <div class="left-side">
            <img src="{{ $product->coverPic('web') }}" alt="image of {{ $product->name }}" class="product-image">
        </div>
        <div class="right-side">
            <section class="product-write-up">
                {!! $product->write_up !!}
            </section>
            <span class="price">NT${{ $product->price }}</span>
            <label class="qty-label" for="quantity">Qty: </label>
            <input class="qty-input" type="number" v-model="quantity">
            <button class="add-btn" v-on:click="addToCart">加入購物車 / Add to cart</button>
        </div>
    </section>
    @include('front.partials.footer')
@endsection

@section('bodyscripts')
    <script>
        new Vue({
            el: '#product-container',

            data: {
                productId: null,
                quantity: 1
            },

            ready: function() {
                var id = document.querySelector('#product-container').getAttribute('data-product');
                this.$set('productId', id);
            },

            methods: {
                addToCart: function() {
                    this.$http.post('/api/cart', {product_id: this.productId, quantity: this.quantity}, function(res) {
                        window.omashuApp.cartIcon.sync(true);
                    }).error(function(res) {
                        console.log(res);
                    })
                }
            }
        });
    </script>
@endsection