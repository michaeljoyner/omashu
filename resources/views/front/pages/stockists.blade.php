@extends('front.base')

@section('content')
    @include('front.partials.nav', ['extraClassName' => ' inverse'])
    <header class="main-page-header">
        <h1 class="page-title"><span><span class="zh-page-title">配合商店</span>stockists</span></h1>
        <p class="brands-spiel">
            <span>請洽以下經銷商</span>
            <br/>
            <span class="seperator">~</span>
            <span>Find our products at these fine retailers.</span>
        </p>
    </header>
    <div class="twocol-wrapper">
        <div class="side-menu">
            <ul class="contents-top-level">
                @foreach($stockists as $stockist)
                    <li><a class="content-menu-item" href="#{{$stockist->slug}}">{{ $stockist->name }}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="main-panel">
            @foreach($stockists as $stockist)
                <div class="stockist-item" id="{{ $stockist->slug }}">
                    <div class="stockist-image-box">
                        <img class="brand-image" src="{{ $stockist->imageSrc() }}" alt="{{ $stockist->name }} image"/>
                    </div>
                    <div class="stockist-info-box">
                        <h2>{{ $stockist->name }}</h2>
                        <p class="stockist-phone"><span class="item-label">電話號碼 / Tel: </span>{{ $stockist->phone }}</p>
                        <p class="stockist-address_zh"><span class="item-label">地址: </span>{{ $stockist->zh_address }}</p>
                        <p class="stockist-address_en"><span class="item-label">Address: </span>{{ $stockist->address }}</p>
                        <p class="stockist-site">
                            <span class="item-label">Website: </span>
                            <a href="{{ $stockist->website }}">{{ $stockist->website }}</a>
                        </p>
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