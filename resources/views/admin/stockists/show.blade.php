@extends('admin.base')

@section('content')
    <div class="conatiner show-container">
        <h1>{{ $stockist->name }}</h1>
        <div class="action-bar">
            <a href="/admin/stockists/edit/{{ $stockist->id }}">
                <div class="btn omashu-btn">Edit</div>
            </a>
            <button type="button" class="btn omashu-btn warning-btn" data-usersname="{{ $stockist->name }}" data-action="/admin/products/{{ $stockist->id }}" data-toggle="modal" data-target="#confirm-delete-modal">
                Delete
            </button>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-7">
                <p><strong>Address: </strong>{{ $stockist->address }}</p>
                <p><strong>Tel: </strong>{{ $stockist->phone }}</p>
                <p><strong>Website: </strong><a href="{{ $stockist->website }}">{{ $stockist->name }}</a></p>
            </div>
            <div class="col-md-5">
                <img class="show-image" src="{{ $stockist->imageSrc() }}" alt=""/>
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