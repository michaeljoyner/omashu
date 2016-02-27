<table>
    <thead>
    <tr>
        <th>Item</th>
        <th>Quantity</th>
        <th>Price</th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $item)
        <tr>
            <td>{{ $item['description'] }}</td>
            <td>{{ $item['quantity'] }}</td>
            <td>NT${{ $item['quantity'] * $item['unit_price'] }}</td>
        </tr>
    @endforeach
    <tr>
        <td colspan="3">Total (with shipping) NT${{ $order_total }}</td>
    </tr>
    </tbody>
</table>