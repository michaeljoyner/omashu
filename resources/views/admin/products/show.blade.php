@extends('admin.base')

@section('head')
    <meta id="x-token" property="CSRF-token" content="{{ Session::token() }}"/>
@stop

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
            <div class="col-md-7 product-show-details">
                <h2 class="product-zh_name">{{ $product->zh_name }}</h2>
                <p class="lead"><span class="quantifier">{{ $product->quantifier }}</span> / <span class="quantifier-zh">{{ $product->zh_quantifier }}</span></p>
                <p class="lead">{{ $product->description }}</p>
                <p class="product-price">NT${{ $product->price }}</p>
                <section class="product-write-up">
                    {!! $product->write_up !!}
                </section>
            </div>
            <div class="col-md-5 single-image-uploader-box product-image-box" id="image-vue">
                <togglebutton url="/admin/api/products/{{ $product->id }}/availability"
                               initial="{{ $product->is_available ? 1 : 0 }}"
                               toggleprop="available"
                               onclass=""
                               offclass="btn-danger"
                               offtext="Make Available"
                               ontext="Mark as Unavailable"
                ></togglebutton>
                <singleupload default="{{ $product->coverPic() }}"
                              url="/admin/api/uploads/products/{{ $product->id }}/image"
                              shape="square"
                              size="large"
                ></singleupload>
            </div>
        </div>


    </div>
    @include('admin.partials.deletemodal')
@endsection

@section('bodyscripts')
    <script>
        new Vue({
            el: '#image-vue'
        });
    </script>
    <script>
        $('#confirm-delete-modal').on('show.bs.modal', function(e) {
            $(this).find('.delete-form').attr('action', $(e.relatedTarget).data('action'));
            $(this).find('.users-name').html($(e.relatedTarget).data('usersname'));
        });
    </script>
@endsection