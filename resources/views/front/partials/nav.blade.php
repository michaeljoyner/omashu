<nav class="front-nav{{ $extraClassName }}">
    <img class="navbranding" src="{{ asset('images/front/navbranding.png') }}" alt="omashu branding"/>
    <label for="nav-menu-checkbox"><span class="zh-menu-label">選單</span>Menu</label>
    <input type="checkbox" id="nav-menu-checkbox" name="nav-menu-checkbox"/>
    <ul>
        @if(Request::path() !== '/')
            <li>
                <a href="/">
                    <div class="om-btn"><span class="btn-zh">首頁</span>home</div>
                </a>
            </li>
        @endif
        @if(Request::path() !== 'brands')
            <li>
                <a href="/brands">
                    <div class="om-btn"><span class="btn-zh">商標</span>brands</div>
                </a>
            </li>
        @endif
        @if(Request::path() !== 'products')
            <li>
                <a href="/products">
                    <div class="om-btn"><span class="btn-zh">產品</span>products</div>
                </a>
            </li>
        @endif
        @if(Request::path() !== 'stockists')
            <li>
                <a href="/stockists">
                    <div class="om-btn"><span class="btn-zh">配合商店</span>stockists</div>
                </a>
            </li>
        @endif
        {{--@if(Request::path() !== 'carty')--}}
            {{--<li>--}}
                {{--<a href="/cart">--}}
                    {{--<div class="om-btn"><span class="btn-zh">購物車</span>cart</div>--}}
                {{--</a>--}}
            {{--</li>--}}
        {{--@endif--}}
    </ul>
</nav>
{{--<div id="cart-box" v-bind:class="{'open': flash}">--}}
    {{--<div class="cart-count" v-show="products > 0">@{{ items }}</div>--}}

    {{--<div class="cart-detail">--}}
        {{--<div class="cart-alert-header">--}}
            {{--<div class="cart-svg">--}}
                {{--@include('svg.cart')--}}
            {{--</div>--}}
            {{--<h3>購物車 / Your cart</h3>--}}
        {{--</div>--}}
        {{--<p>產品 / Products: @{{ products }}</p>--}}
        {{--<p>项目 / Items: @{{ items }}</p>--}}
        {{--<p>金額 / Price: NT$@{{ total }}</p>--}}
        {{--<a href="/cart">--}}
            {{--<div class="om-btn">Go to Cart</div>--}}
        {{--</a>--}}
    {{--</div>--}}

{{--</div>--}}