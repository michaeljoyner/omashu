<p>We have received a new order via the site.</p>

<h3>Customer Details</h3>
<p><strong>Name: </strong>{{ $customer_name }}</p>
<p><strong>Email: </strong>{{ $customer_email }}</p>
<p><strong>Phone no: </strong>{{ $customer_phone }}</p>
<p><strong>Address:</strong></p>
<p>{!! nl2br($address) !!}</p>

@if($customer_query !== '')
    <h4>Customer Comments</h4>
    <p>{{ $customer_query }}</p>
@endif

<h3>Order details</h3>
<p><strong>Order number: </strong>{{ $order_number }}</p>
@include('emails.partials.itemtable')

<p>View order <a href="https://omashuimports.com/admin/orders/{{ $order_id }}">on the site</a></p>