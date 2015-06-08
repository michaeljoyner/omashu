@extends('admin.base')

@section('content')
    <h1>Our Stockists</h1>
    @foreach($stockists as $stockist)
        <div class="stockist-box">
            <h3>{{ $stockist->name }}</h3>
            <p>Address: {{ $stockist->address }}</p>
            <p>Tel: {{ $stockist->phone }}</p>
            <p>Website: <a href="{{ $stockist->website }}">{{ $stockist->name }}</a></p>
        </div>
    @endforeach
@endsection