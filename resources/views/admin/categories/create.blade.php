@extends('admin.base')


@section('content')
    <h1>Create a New Category for {{ $brand->name }}</h1>
    @include('admin.partials.errors')
    @include('admin.categories.categoryform', [
        'category' => $category,
        'formAction' => 'admin/brands/'.$brand->id.'/categories',
        'submitText' => 'Add Category', 'formId' => 'category-create'
    ])
@endsection

