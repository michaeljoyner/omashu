@extends('admin.base')

@section('head')
    <meta property="CSRF-token" content="{{ Session::token() }}"/>
@stop

@section('content')
    <h1>Edit Brand</h1>
    @include('admin.partials.errors')
    <div class="row">
        <div class="col-md-7">
            @include('admin.brands.brandform', ['brand' => $brand, 'submitText' => 'Save Changes', 'formAction' => 'admin/brands/edit/'.$brand->id, 'formId' => 'brand-edit'])
        </div>
        <div class="col-md-5">
            @include('admin.partials.dropzoneform', ['currentImg' => $brand->imageSrc(), 'uploadURL' => '/admin/ajaxuploads/brands/imageupload', 'dzFormId' => 'brand-pic-dropzone', 'previewId' => 'image-preview'])
        </div>
    </div>
@endsection

@section('bodyscripts')
    <script>
        var dzManager = new DropzoneManager('brandPicDropzone', 'brand-edit', 'brand-image', 'image_path', 'image-preview');
        dzManager.init();
    </script>
@endsection