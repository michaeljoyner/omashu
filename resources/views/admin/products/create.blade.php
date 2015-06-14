@extends('admin.base')

@section('head')
    <meta property="CSRF-token" content="{{ Session::token() }}"/>
@stop

@section('content')
    <h1>Add a New Product to {{ $category->name }}</h1>
    @include('admin.partials.errors')
    <div class="row">
        <div class="col-md-7">
            @include('admin.products.productform', ['product' => $product, 'formAction' => 'admin/products/'.$category->id, 'submitText' => 'Add Product', 'formId' => 'product-create'])
        </div>
        <div class="col-md-5">
            @include('admin.partials.dropzoneform', ['currentImg' => $product->imageSrc(), 'uploadURL' => '/admin/ajaxuploads/products/imageupload', 'dzFormId' => 'product-pic-dropzone', 'previewId' => 'image-preview'])
        </div>
    </div>
@endsection

@section('bodyscripts')
    <script>
        var dzManager = new DropzoneManager('productPicDropzone', 'product-create', 'product-image', 'image_path', 'image-preview');
        dzManager.init();
    </script>
@endsection