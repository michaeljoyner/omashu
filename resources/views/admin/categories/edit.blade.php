@extends('admin.base')

@section('head')
    <meta property="CSRF-token" content="{{ Session::token() }}"/>
@stop

@section('content')
    <h1>Edit This Category</h1>
    @include('admin.partials.errors')
    <div class="row">
        <div class="col-md-7">
            @include('admin.categories.categoryform', ['category' => $category, 'formAction' => 'admin/categories/edit/'.$category->id, 'submitText' => 'Save Changes', 'formId' => 'category-edit'])
        </div>
        <div class="col-md-5">
            @include('admin.partials.dropzoneform', ['currentImg' => $category->imageSrc(), 'uploadURL' => '/admin/ajaxuploads/categories/imageupload', 'dzFormId' => 'category-pic-dropzone', 'previewId' => 'image-preview'])
        </div>
    </div>
@endsection

@section('bodyscripts')
    <script>
        var dzManager = new DropzoneManager('categoryPicDropzone', 'category-edit', 'category-image', 'image_path', 'image-preview');
        dzManager.init();
    </script>
@endsection