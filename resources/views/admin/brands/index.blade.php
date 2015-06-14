@extends('admin.base')

@section('content')
    <div class="container show-container">
        <h1>Our Brands</h1>

        <div class="action-bar"><a href="/admin/brands/create">
                <div class="btn omashu-btn">Add Brand</div>
            </a></div>
        <hr/>
        @foreach($brands as $brand)
            <div class="brand-box display-card">
                <h4><a href="/admin/brands/{{ $brand->slug }}">{{ $brand->name }}</a></h4>
                <p class="tagline">{{ $brand->tagline }}</p>
                <a href="/admin/brands/{{ $brand->slug }}">
                    <img src="{{ $brand->imageSrc() }}" alt=""/>
                </a>
                <a href="{{ $brand->website }}"><div class="btn omashu-btn">website</div></a>
            </div>
        @endforeach
    </div>
@endsection