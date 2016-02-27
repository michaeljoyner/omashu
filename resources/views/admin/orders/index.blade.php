@extends('admin.base')

@section('content')
    <div class="container show-container">
        <h1>{{ $status }} Orders</h1>
        <div class="action-bar">
            <a href="/admin/orders/archived">
                <div class="btn omashu-btn">View Archives</div>
            </a>
        </div>
        <hr/>
        <section class="orders-table">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr class="{{ $order->status() }}">
                        <td class="order-number"><a href="/admin/orders/{{ $order->id }}">{{ $order->order_number }}</a></td>
                        <td>{{ $order->created_at->toFormattedDateString() }}</td>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->email }}</td>
                        <td>{{ $order->status() }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </section>
        {!! $orders->render() !!}
    </div>
@endsection