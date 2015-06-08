@extends('admin.base')

@section('content')
    <h1>Our Brands</h1>
    @foreach($brands as $brand)
        <div class="brand-box">
            <h4><a href="/admin/brands/{{ $brand->slug }}">{{ $brand->name }}</a></h4>
            <p class="tagline">{{ $brand->tagline }}</p>
            <p class="intro">{{ $brand->description }}</p>
            <a href="{{ $brand->website }}">website</a>
        </div>
    @endforeach
@endsection