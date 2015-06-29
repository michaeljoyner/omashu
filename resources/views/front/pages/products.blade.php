@extends('front.base')

@section('content')
    @include('front.partials.nav', ['extraClassName' => ' inverse'])
    <header class="main-page-header">
        <h1 class="page-title"><span><span class="zh-page-title">產品</span>Products</span></h1>
        <p class="brands-spiel">
            <span>我們堅決相信我們進口的產品；其品質是達到國外及國內商品品質管制標準。這樣一來，你們絕對可以相信我們的產品。</span>
            <br/>
            <span class="seperator">~</span>
            <span>Omashu firmly believes in what we import. We ensure quality by endorsing products which meet standards set by foreign and domestic regulatory agencies. That way, you can believe in what we import, too.</span>
        </p>
    </header>
    <div class="twocol-wrapper">
        <div class="side-menu">
            <ul class="contents-top-level">
                @foreach($brands as $index => $brand)
                    <li>
                        <label for="brand_{{ $index }}">{{ $brand->name }}</label>
                        <input type="radio" name="menu_toggle_select" id="brand_{{ $index }}" class="contents-checkbox"/>
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
                    <h1 class="category-title">{{ $category->zh_name }}</h1>
                    <h2 class="category-title-eng">{{ $category->name }}</h2>
                    @foreach($category->products as $product)
                        <div class="product-item">
                            <div class="product-image-box">
                                <img src="{{ $product->imageSrc() }}" alt="{{ $product->name }} image"/>
                            </div>
                            <div class="product-description-box">
                                <h4>{{ $product->zh_name }}</h4>
                                <p class="product-eng_name">{{ $product->name }}</p>
                                <p class="product-quantifier">{{ $product->zh_quantifier }}</p>
                                <p class="product-quantifier">{{ $product->quantifier }}</p>
                            </div>
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