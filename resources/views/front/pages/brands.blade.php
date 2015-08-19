@extends('front.base')

@section('seotags')
    <meta name="description" content="歡迎參訪以下精選品牌。 Have a look at Omashu Imports' trusted brands."/>
    @include('front.partials.ogmeta', [
        'og_url' => 'http://omashuimports.com/brands',
        'og_title' => 'Our Brands - Omashu Imports',
        'og_description' => '歡迎參訪以下精選品牌。 Have a look at Omashu Imports\' trusted brands.'
    ])
    <link rel="canonical" href="http://omashuimports.com/brands"/>
@endsection

@section('content')
    @include('front.partials.nav', ['extraClassName' => ' inverse'])
    <header class="main-page-header">
        <h1 class="page-title"><span><span class="zh-page-title">商標</span>Brands</span></h1>
        <p class="brands-spiel"><span class="zh-header">緒康貿易有限公司以能尋找出世界最頂尖的產品為榮。我們已經與同業建立起堅定且互信的關係。</span>
            <br/>
            <span class="seperator">~</span>
            <span>Omashu Imports prides itself on seeking out the finest products from around the world. We have established strong, trusting relationships with all of our associates.</span>
        </p>
    </header>
    <div class="twocol-wrapper">
        <div class="side-menu">
            <ul class="contents-top-level">
            @foreach($brands as $brand)
                    <li><a class="content-menu-item" href="#{{$brand->slug}}">{{ $brand->name }}</a></li>
            @endforeach
            </ul>
        </div>
        <div class="main-panel">
            @foreach($brands as $brand)
                <div class="brand-item" id="{{ $brand->slug }}">
                    <img class="brand-image" src="{{ $brand->imageSrc() }}" alt="{{ $brand->name }} image"/>
                    <h2>{{ $brand->name }}</h2>
                    <p class="brand-description">{{ $brand->description }}</p>
                    <p class="brand-location"><span class="item-label">Location: </span>{{ $brand->location }}</p>
                    <p class="brand-site"><span class="item-label">Website: </span><a href="{{ $brand->website }}">{{ $brand->website }}</a></p>
                    <div class="centered-button-box">
                        <a href="/products#{{ $brand->slug }}">
                            <div class="om-btn">Products</div>
                        </a>
                    </div>
                </div>
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