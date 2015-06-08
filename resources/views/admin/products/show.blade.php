@extends('admin.base')

@section('content')
    <h1>{{ $product->name }}</h1>
    <p>{{ $product->quantifier }}</p>
    <p>{{ $product->description }}</p>
    <p>Product is  @if(! $product->is_available) not @endif available</p>
    <a href="/admin/products/edit/{{ $product->id }}">
        <div>Edit</div>
    </a>
    <button type="button" class="btn btn-danger" data-usersname="{{ $product->name }}" data-action="/admin/products/{{ $product->id }}" data-toggle="modal" data-target="#confirm-delete-modal">
        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete
    </button>
    @include('admin.partials.deletemodal')
@endsection

@section('bodyscripts')
    <script>
        $('#confirm-delete-modal').on('show.bs.modal', function(e) {
            $(this).find('.delete-form').attr('action', $(e.relatedTarget).data('action'));
            $(this).find('.users-name').html($(e.relatedTarget).data('usersname'));
        });
    </script>
@endsection