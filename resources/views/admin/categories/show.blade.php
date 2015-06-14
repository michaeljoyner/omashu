@extends('admin.base')

@section('content')
    <div class="container show-container show-category">
        <h1>{{ $category->name }}</h1>
        <div class="action-bar">
            <a href="/admin/categories/edit/{{ $category->id }}">
                <div class="btn omashu-btn">Edit</div>
            </a>
            <button type="button" class="btn omashu-btn warning-btn" data-usersname="{{ $category->name }}" data-action="/admin/categories/{{ $category->id }}" data-toggle="modal" data-target="#confirm-delete-modal">
                Delete
            </button>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-7">
                <p>{{ $category->description }}</p>
            </div>
            <div class="col-md-5">
                <img src="{{ $category->imageSrc() }}" alt=""/>
            </div>
        </div>
        <hr/>
    </div>
    <div class="container show-container category-product-list">
    <h2>Products</h2>
        <div class="action-bar">
            <a href="/admin/products/create/{{ $category->id }}">
                <div class="btn omashu-btn">Add Product</div>
            </a>
        </div>
        @foreach($category->products as $product)
            <div class="product-box display-card">
                <h4><a href="/admin/products/{{ $product->slug }}">{{ $product->name }}</a></h4>
                <p>{{ $product->quantifier }}</p>
                <a href="/admin/products/{{ $product->slug }}">
                    <img src="{{ $product->imageSrc() }}" alt=""/>
                </a>
            </div>
        @endforeach
    </div>
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