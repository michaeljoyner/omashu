@extends('admin.base')

@section('content')
    <h1>{{ $brand->name }}</h1>
    <p>{{ $brand->tagline }}</p>
    <hr/>
    <p>{{ $brand->description }}</p>
    <p>Website: <a href="{{ $brand->website }}">{{ $brand->name }}</a></p>
    <a href="/admin/brands/edit/{{ $brand->id }}">
        <div>Edit</div>
    </a>
    <button type="button" class="btn btn-danger" data-usersname="{{ $brand->name }}" data-action="/admin/brands/{{ $brand->id }}" data-toggle="modal" data-target="#confirm-delete-modal">
        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete
    </button>
    <hr/>
    <h2>Categories</h2>
    @foreach($brand->categories as $category)
        <div class="category-box">
            <h3><a href="/admin/categories/{{ $category->slug }}">{{ $category->name }}</a></h3>
            <p>{{ $category->description }}</p>
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