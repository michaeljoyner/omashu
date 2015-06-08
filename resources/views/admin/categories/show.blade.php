@extends('admin.base')

@section('content')
    <h1>{{ $category->name }}</h1>
    <p>{{ $category->description }}</p>
    <a href="/admin/categories/edit/{{ $category->id }}">
        <div>Edit</div>
    </a>
    <button type="button" class="btn btn-danger" data-usersname="{{ $category->name }}" data-action="/admin/categories/{{ $category->id }}" data-toggle="modal" data-target="#confirm-delete-modal">
        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete
    </button>
    <hr/>
    <h2>Products</h2>
    @foreach($category->products as $product)
        <div class="product-box">
            <h4><a href="/admin/products/{{ $product->slug }}">{{ $product->name }}</a></h4>
            <p>{{ $product->quantifier }}</p>
            <p>{{ $product->description }}</p>
        </div>
    @endforeach
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