<table style="border-collapse: collapse; border: 1px solid #bbbbbb; width: 100%;">
    <thead>
    <tr>
        <th style="padding: 10px; border: 1px solid #bbbbbb;">項目 | Item</th>
        <th style="padding: 10px; border: 1px solid #bbbbbb;">數量 | Quantity</th>
        <th style="padding: 10px; border: 1px solid #bbbbbb;">價格 | Price</th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $item)
        <tr>
            <td style="padding: 10px; border: 1px solid #bbbbbb;">{{ $item['description'] }}</td>
            <td style="padding: 10px; border: 1px solid #bbbbbb; text-align: right;">{{ $item['quantity'] }}</td>
            <td style="padding: 10px; border: 1px solid #bbbbbb; text-align: right;">NT${{ $item['quantity'] * $item['unit_price'] }}</td>
        </tr>
    @endforeach
    <tr>
        <td style="padding: 10px; border: 1px solid #bbbbbb; text-align: right;" colspan="3">運費 NT${{ $shipping_fee }}</td>
    </tr>
    <tr>
        <td colspan="3" style="padding: 10px; font-size: 1.5em; font-weight: 700; border: 1px solid #bbbbbb; text-align: right;">總額（含運費） NT${{ $order_total }}</td>
    </tr>
    </tbody>
</table>