@extends('admin.base')

@section('content')
    <div class="container show-container">
        <h1>Our Stockists</h1>
        <div class="action-bar">
            <a href="/admin/stockists/create">
                <div class="btn omashu-btn">Add Stockist</div>
            </a>
        </div>
        <hr/>
        @foreach($stockists as $stockist)
            <div class="row stockist-row">
                <div class="col-md-7">
                    <div class="stockist-box">
                        <h3><a href="/admin/stockists/{{ $stockist->slug }}">{{ $stockist->name }}</a></h3>
                        <p>Address: {{ $stockist->address }}</p>
                        <p>Tel: {{ $stockist->phone }}</p>
                        <p>Website: <a href="{{ $stockist->website }}">{{ $stockist->name }}</a></p>
                    </div>
                </div>
                <div class="col-md-5">
                    <img class="show-image" src="{{ $stockist->imageSrc() }}" alt=""/>
                </div>
            </div>
        @endforeach
    </div>
@endsection