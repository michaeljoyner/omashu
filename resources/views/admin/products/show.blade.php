@extends('admin.base')

@section('content')
    <div class="container show-container show-product">
        <h1>{{ $product->name }}</h1>
        <div class="action-bar">
            <a href="/admin/products/edit/{{ $product->id }}">
                <div class="btn omashu-btn">Edit</div>
            </a>
            <button type="button" class="btn omashu-btn warning-btn" data-usersname="{{ $product->name }}" data-action="/admin/products/{{ $product->id }}" data-toggle="modal" data-target="#confirm-delete-modal">
                Delete
            </button>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-7">
                <p>{{ $product->quantifier }}</p>
                <p>{{ $product->description }}</p>
                <p>Product is  @if(! $product->is_available) not @endif available</p>
            </div>
            <div class="col-md-5">
                <img class="show-image" src="{{ $product->imageSrc() }}" alt=""/>
            </div>
        </div>


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