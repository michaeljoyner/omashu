@extends('admin.base')

@section('content')
    <h1>Edit This Stockist</h1>
    @include('admin.partials.errors')
    @include('admin.stockists.stockistform', ['stockist' => $stockist, 'formAction' => 'admin/stockists/edit/'.$stockist->id, 'submitText' => 'Save Changes'])
@endsection