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
    <template id="cart-item-template">
        <div class="cart-item">
            <img v-bind:src="thumb" alt="" class="product-thumb">
            <div class="cart-item-detail-container">
                <span class="item-description">@{{ description }}</span>
                <span class="item-price">NT$@{{ actualqty * price }}</span>
                <div class="editing-block">
                    <input type="number" v-model="newqty" class="newqty-input" :disabled="!editing">
                    <div class="edit-btn" :class="{'edit': editing}" v-on:click="handleEditClick">
                        @include('svg.edit')
                        @include('svg.save')
                    </div>
                </div>
            </div>

        </div>
    </template>
@endsection

@section('bodyscripts')
    <script>
        Vue.component('cartitem', {
            props: ['rowid', 'id', 'description', 'quantity', 'thumb', 'price'],

            template: '#cart-item-template',

            data: function () {
                return {
                    newqty: 1,
                    actualqty: 1,
                    editing: false
                }
            },

            computed: {
                editTxt: function () {
                    return this.editing ? 'Save' : 'Edit';
                }
            },

            ready: function () {
                this.$set('newqty', this.quantity);
                this.$set('actualqty', this.quantity);
            },

            methods: {
                handleEditClick: function () {
                    if (!this.editing) {
                        this.editing = true;
                        return;
                    }

                    this.updateQuantity();
                },



                updateQuantity: function () {
                    this.$http.put('api/cart/' + this.rowid, {quantity: this.newqty}, function () {
                        this.editing = false;
                        this.actualqty = this.newqty;
                        window.omashuApp.cartIcon.sync(true);
                        this.$dispatch('quantity-updated');
                    }).error(function (res) {
                        console.log(res);
                    });
                }
            }
        });

        var cart = new Vue({
            el: '#cart-list-container',

            data: {
                items: [],
                subtotal: null,
                shipping: null,
                total: null
            },

            ready: function () {
                this.fetchItems();
                this.updateTotals();
            },

            methods: {
                fetchItems: function () {
                    this.$http.get('/api/cart', function (res) {
                        this.$set('items', res);
                    }).error(function (res) {
                        console.log(res);
                    })
                },

                removeItem: function (item) {
                    this.$http.delete('/api/cart/' + item.rowid, function () {
                        this.items.$remove(item);
                        omashuApp.cartIcon.sync(true);
                        this.updateTotals();
                    }).error(function (res) {
                        console.log(res);
                    });
                },

                updateTotals: function () {
                    this.$http.get('/api/cart/totals', function (res) {
                        this.$set('subtotal', res.subtotal);
                        this.$set('shipping', res.shipping);
                        this.$set('total', res.total);
                    })
                }
            },

            events: {
                'quantity-updated': function () {
                    this.updateTotals();
                }
            }
        });
    </script>
@endsection