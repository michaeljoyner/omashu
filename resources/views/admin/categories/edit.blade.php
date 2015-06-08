@extends('admin.base')

@section('content')
    <h1>Edit This Category</h1>
    @include('admin.partials.errors')
    @include('admin.categories.categoryform', ['category' => $category, 'formAction' => 'admin/categories/edit/'.$category->id, 'submitText' => 'Save Changes'])
@endsection