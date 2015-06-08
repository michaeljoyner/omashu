@extends('admin.base')

@section('content')
    <h1>Create a New Category for {{ $brand->name }}</h1>
    @include('admin.partials.errors')
    @include('admin.categories.categoryform', ['category' => $category, 'formAction' => 'admin/categories/'.$brand->id, 'submitText' => 'Add Category'])
@endsection