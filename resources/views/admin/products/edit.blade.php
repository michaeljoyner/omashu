@extends('admin.base')

@section('content')
    <h1>Edit This Product</h1>
    @include('admin.partials.errors')
    @include('admin.products.productform', ['product' => $product, 'formAction' => 'admin/products/edit/'.$product->id, 'submitText' => 'Save Changes'])
@endsection