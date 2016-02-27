@extends('admin.base')

@section('head')
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@stop

@section('content')
    <h1>Add a New Product to {{ $category->name }}</h1>
    @include('admin.partials.errors')
    @include('admin.products.productform', [
        'product' => $product,
        'formAction' => 'admin/categories/' . $category->id . '/products',
        'submitText' => 'Add Product', 'formId' => 'product-create'
    ])
@endsection

@section('bodyscripts')
    <script>
        tinymce.init({
            selector: '#writer',
            plugins: ['link', 'paste', 'fullscreen'],
            menubar: false,
            toolbar: 'undo redo | styleselect | bold italic | link bullist numlist | fullscreen',
            paste_data_images: false,
            height: 500,
            content_style: "body {font-size: 16px; max-width: 800px; margin: 0 auto; padding: 10px;} * {font-size: 16px;}"
        });
    </script>
@endsection