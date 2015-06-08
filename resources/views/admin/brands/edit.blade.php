@extends('admin.base')

@section('content')
    <h1>Edit Brand</h1>
    @include('admin.partials.errors')
    @include('admin.brands.brandform', ['brand' => $brand, 'submitText' => 'Save Changes', 'formAction' => 'admin/brands/edit/'.$brand->id])
@endsection