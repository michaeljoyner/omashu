@extends('admin.base')

@section('head')
    <meta id="x-token" property="CSRF-token" content="{{ Session::token() }}"/>
@stop

@section('content')
    <div class="container show-container">
        <h1>Order #{{ $order->order_number }}</h1>
        <div class="action-bar">
            <button type="button" class="btn omashu-btn warning-btn" data-usersname="{{ $order->order_number }}" data-action="/admin/orders/{{ $order->id }}" data-toggle="modal" data-target="#confirm-delete-modal">
                Archive
            </button>
        </div>
        <hr/>
        <div class="order-status-toggles">
            <togglebutton url="/admin/api/orders/{{ $order->id }}/cancel"
                          initial="{{ $order->is_cancelled ? 1 : 0 }}"
                          toggleprop="cancel"
                          onclass=""
                          offclass="btn-danger"
                          offtext="Cancel Order"
                          ontext="Restore Order"
            ></togglebutton>
            <togglebutton url="/admin/api/orders/{{ $order->id }}/pay"
                          initial="{{ $order->is_paid ? 1 : 0 }}"
                          toggleprop="pay"
                          onclass=""
                          offclass="btn-danger"
                          offtext="Mark as Paid"
                          ontext="Mark as unpaid"
            ></togglebutton>
            <togglebutton url="/admin/api/orders/{{ $order->id }}/ship"
                          initial="{{ $order->is_shipped ? 1 : 0 }}"
                          toggleprop="ship"
                          onclass=""
                          offclass="btn-danger"
                          offtext="Mark as Shipped"
                          ontext="Mark as Undelivered"
            ></togglebutton>
        </div>
        <section class="order-summary row">
            <div class="col-md-6">
                <p class="lead"><span class="field-label">Customer Name: </span>{{ $order->name }}</p>
                <p class="lead"><span class="field-label">Email: </span>{{ $order->email }}</p>
                <p class="lead"><span class="field-label">Phone: </span>{{ $order->phone }}</p>
                <p class="block-lable">Address:</p>
                <p class="lead">{!! nl2br($order->address) !!}</p>
            </div>
            <div class="col-md-6">
                <p class="lead"><span class="field-label">Status: </span>{{ $order->status() }}</p>
                <p class="lead"><span class="field-label">Order total: NT${{ $order->total_price }}</span></p>
                <p class="lead"><span class="field-label">Date created: {{ $order->created_at->toFormattedDateString() }}</span></p>
                <p class="block-lable">Additional Comments:</p>
                <p class="lead">{!! nl2br($order->customer_query) !!}</p>
            </div>
        </section>
        <hr>
        <section class="row order-items-section">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Description</th>
                    <th>Quantity Ordered</th>
                    <th>Unit Price Charged</th>
                    <th>Item Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach($order->items as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>NT${{ $item->unit_price }}</td>
                        <td>NT${{ $item->unit_price * $item->quantity }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </section>
    </div>
@endsection
@include('admin.partials.deletemodal')

@section('bodyscripts')
    <script>
        new Vue({el: 'body'});
    </script>
    @include('admin.partials.deletescript')
@endsection