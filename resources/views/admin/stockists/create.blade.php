@extends('admin.base')

@section('content')
    <h1>Add a New Stockist</h1>
    @include('admin.partials.errors')
    @include('admin.stockists.stockistform', ['stockist' => $stockist, 'formAction' => 'admin/stockists', 'submitText' => 'Add Stockist'])
@endsection