@extends('admin.base')

@section('content')
    <div class="container brand-showarea show-container">
        <h1>{{ $brand->name }}</h1>
        <p>{{ $brand->tagline }}</p>
        <div class="action-bar">
            <a href="/admin/brands/edit/{{ $brand->id }}">
                <div class="btn omashu-btn">Edit</div>
            </a>
            <button type="button" class="btn omashu-btn warning-btn" data-usersname="{{ $brand->name }}" data-action="/admin/brands/{{ $brand->id }}" data-toggle="modal" data-target="#confirm-delete-modal">
                 Delete
            </button>
        </div>
        <hr/>
        <div class="row brand-desc">
            <div class="col-sm-7">
                <p>{{ $brand->description }}</p>
                <p>Website: <a href="{{ $brand->website }}">{{ $brand->name }}</a></p>
            </div>
            <div class="col-sm-5 brand-showimage-box">
                <img src="{{ $brand->imageSrc() }}" alt=""/>
            </div>
        </div>


        <hr/>
    </div>
    <div class="container category-listarea show-container">
        <h2>Categories</h2>
        <div class="action-bar">
            <a href="/admin/categories/create/{{ $brand->id }}">
                <div class="btn omashu-btn">New Category</div>
            </a>
        </div>
        @foreach($brand->categories as $category)
            <div class="category-box display-card">
                <h3><a href="/admin/categories/{{ $category->slug }}">{{ $category->name }}</a></h3>
                <p>{{ $category->description }}</p>
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