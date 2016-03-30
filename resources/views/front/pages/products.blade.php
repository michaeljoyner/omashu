@extends('front.base')

@section('seotags')
    <meta name="description" content="歡迎選購各式產品。 Browse through Omashu Imports' extensive line of products."/>
    @include('front.partials.ogmeta', [
        'og_url' => 'http://omashuimports.com/products',
        'og_title' => 'Our Products - Omashu Imports',
        'og_description' => '歡迎選購各式產品。 Browse through Omashu Imports\' extensive line of products.'
    ])
    <link rel="canonical" href="http://omashuimports.com/products"/>
@endsection

@section('content')
    @include('front.partials.nav', ['extraClassName' => ' inverse'])
    <header class="main-page-header">
        <h1 class="page-title"><span><span class="zh-page-title">產品</span>Products</span></h1>
        <p class="brands-spiel">
            <span class="zh-header">我們對我們產品的自信，來自我們對我們產品的了解。 我們不輕易妥協，也希望您能支持我們對食安的堅持。</span>
            <br/>
            <span class="seperator">~</span>
            <span>Omashu firmly believes in what we import. We ensure quality by endorsing products which meet standards set by foreign and domestic regulatory agencies. That way, you can believe in what we import, too.</span>
        </p>
        {{--<p class="upcoming-shop-alert white-text">Shop coming soon</p>--}}
    </header>
    <div class="twocol-wrapper">
        <div class="side-menu">
            <ul class="contents-top-level">
                @foreach($brands as $index => $brand)
                    <li>
                        <label for="brand_{{ $index }}">{{ $brand->name }}</label>
                        <input type="radio" name="menu_toggle_select" id="brand_{{ $index }}" class="contents-checkbox" @if($brands->count() === 1) checked @endif/>
                        <ul class="contents-second-level">
                            @foreach($brand->categories as $category)
                                <li><a class="content-menu-item" href="#{{ $category->slug }}">{{ $category->zh_name }} | {{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="main-panel">
            @foreach($brands as $brand)
            <section id="{{ $brand->slug }}">
                @foreach($brand->categories as $category)
                <div id="{{ $category->slug }}" class="category-container">
                    <header class="category-title-box">
                        <h1 class="category-title">{{ $category->zh_name }}</h1>
                        <h2 class="category-title-eng">{{ $category->name }}</h2>
                    </header>
                    @foreach($category->products as $product)
                        <div class="product-item">
                            <a href="/product/{{ $product->slug }}">
                                <div class="product-image-box">
                                    <img src="{{ $product->coverPic() }}" alt="{{ $product->name }} image"/>
                                </div>
                            </a>
                            <div class="product-description-box">
                                <h4>{{ $product->zh_name }}</h4>
                                <p class="product-eng_name">{{ $product->name }}</p>
                                <p class="product-quantifier">{{ $product->zh_quantifier }}</p>
                                <p class="product-quantifier">{{ $product->quantifier }}</p>
                                <p class="product-price">NT${{ $product->price }}</p>
                            </div>
                            <a href="/product/{{ $product->slug }}">
                                <div class="om-btn view-btn">檢視產品 / View Product</div>
                            </a>
                        </div>
                    @endforeach
                </div>
                @endforeach
            </section>
            @endforeach
        </div>
        <div class="clearfix"></div>
    </div>
    @include('front.partials.footer')
@endsection

@section('bodyscripts')
    <script>
                menuManager.init();
    </script>
@endsection