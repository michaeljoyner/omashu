@extends('admin.base')

@section('content')
    <h1>Add a New Product to {{ $category->name }}</h1>
    @include('admin.partials.errors')
    @include('admin.products.productform', ['product' => $product, 'formAction' => 'admin/products/'.$category->id, 'submitText' => 'Add Product'])
@endsection