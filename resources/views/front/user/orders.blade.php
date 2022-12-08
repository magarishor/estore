@if($orders->isNotEmpty())
    <table class="table table-striped table-hover table-sm">
        <thead>
        <tr>
            <th>Details</th>
            <th>Total</th>
            <th>Status</th>
            <th>Ordered On</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>
                    <ul>
                        @foreach($order->details as $detail)
                            <li>{{ $detail->qty }} x {{ $detail['product']->name }} @ Rs. {{ number_format($detail->rate) }} = <strong>Rs. {{ number_format($detail->total) }}</strong></li>
                        @endforeach
                    </ul>
                </td>
                <td>Rs. {{ number_format($order->details->sum('total') ) }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <h4 class="text-center">No order made yet.</h4>
@endif
