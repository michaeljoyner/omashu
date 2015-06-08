@extends('admin.base')

@section('content')
    <h1>Add a New Brand</h1>
    @include('admin.partials.errors')
    @include('admin.brands.brandform', ['brand' => $brand, 'submitText' => 'Add Brand', 'formAction' => 'admin/brands'])
@endsection