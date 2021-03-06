@extends('admin.base')

@section('head')
    <meta property="CSRF-token" content="{{ Session::token() }}"/>
@stop

@section('content')
    <h1>Edit This Stockist</h1>
    @include('admin.partials.errors')
    <div class="row">
        <div class="col-md-7">
            @include('admin.stockists.stockistform', ['stockist' => $stockist, 'formAction' => 'admin/stockists/edit/'.$stockist->id, 'submitText' => 'Save Changes', 'formId' => 'stockist-edit'])
        </div>
        <div class="col-md-5">
            @include('admin.partials.dropzoneform', ['currentImg' => $stockist->imageSrc(), 'uploadURL' => '/admin/ajaxuploads/stockists/imageupload', 'dzFormId' => 'stockist-pic-dropzone', 'previewId' => 'image-preview'])
        </div>
    </div>
@endsection

@section('bodyscripts')
    <script>
        var dzManager = new DropzoneManager('stockistPicDropzone', 'stockist-edit', 'stockist-image', 'image_path', 'image-preview');
        dzManager.init();
    </script>
@endsection