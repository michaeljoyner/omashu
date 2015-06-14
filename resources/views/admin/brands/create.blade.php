@extends('admin.base')

@section('head')
    <meta property="CSRF-token" content="{{ Session::token() }}"/>
@stop

@section('content')
    <h1>Add a New Brand</h1>
    @include('admin.partials.errors')
    <div class="row">
        <div class="col-md-7">
            @include('admin.brands.brandform', ['brand' => $brand, 'submitText' => 'Add Brand', 'formAction' => 'admin/brands', 'formId' => 'brand-create'])
        </div>
        <div class="col-md-5">
            @include('admin.partials.dropzoneform', ['currentImg' => $brand->image_path, 'uploadURL' => '/admin/ajaxuploads/brands/imageupload', 'dzFormId' => 'brand-pic-dropzone', 'previewId' => 'image-preview'])
        </div>
    </div>
@endsection

@section('bodyscripts')
    <script>
        var dzManager = new DropzoneManager('brandPicDropzone', 'brand-create', 'brand-image', 'image_path', 'image-preview');
        dzManager.init();
    </script>
@endsection