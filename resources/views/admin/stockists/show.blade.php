@extends('admin.base')

@section('content')
    <h1>{{ $stockist->name }}</h1>
    <hr/>
    <p>{{ $stockist->address }}</p>
    <p>{{ $stockist->phone }}</p>
    <p>Website: <a href="{{ $stockist->website }}">{{ $stockist->name }}</a></p>
    <a href="/admin/stockists/edit/{{ $stockist->id }}">
        <div>Edit</div>
    </a>
    <button type="button" class="btn btn-danger" data-usersname="{{ $stockist->name }}" data-action="/admin/products/{{ $stockist->id }}" data-toggle="modal" data-target="#confirm-delete-modal">
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