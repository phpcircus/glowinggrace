<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Orders</title>
</head>
<body>
<h1 style="color: #2d3748; font-family: 'open_sans'; font-size: 1.25rem; font-weight: bold; width: 100%; margin-bottom: 42px;">Team Kimberlyn Tshirt Orders</h1>
<table class="table table-striped table-fixed" style="width: 100%;">
    <thead>
        <tr>
            <th style="width: 200px; text-decoration: underline;">Name</th>
            <th style="width: 120px; text-decoration: underline;">Type?</th>
            <th style="text-decoration: underline;">Items</th>
            <th style="text-decoration: underline;">Deliver to</th>
            <th style="text-decoration: underline;">Complete?</th>
            <th style="text-decoration: underline;">Total</th>
        </tr>
    </thead>
    <tbody>
        @forelse($orders as $order)
            <tr style="height: 100px;">
                <td style="width: 200px;">{{ $order->customer->name }}</td>
                <td style="width: 120px;">{{ $order->method }}</td>
                <td>
                    @foreach($order->lineItems as $item)
                        <span style="margin-right: 12px;">({{ $item->quantity }})</span><span>{{ $item->size->slug }}</span> <br>
                    @endforeach
                </td>
                @if($order->method === 'shipped')
                    <td>{{ $order->address }} {{ $order->city }}, {{ $order->state }} {{ $order->zip }}</td>
                @endif
                @if ($order->method === 'pickup')
                    <td>{{ $order->pickup_location }}</td>
                @endif
                <td>{{ $order->delivered ? 'complete' : 'waiting' }}</td>
                <td> {{ $order->readable_total }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="7">No orders found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
</body>
</html>
