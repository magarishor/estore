@extends('layouts.cms')

@section('content')
    <main class="row">
        <div class="col-12 bg-white my-3 py-3">
            <div class="row">
                <div class="col">
                    <h1>Orders</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    @if($orders->isNotEmpty())
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>User</th>
                                <th>Detail</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $order->user->name }}</td>
                                        <td>
                                            <ul>
                                                @foreach($order->details as $detail)
                                                    <li>{{ $detail->qty }} x {{ $detail['product']->name }} @ Rs. {{ number_format($detail->rate) }} = <strong>Rs. {{ number_format($detail->total) }}</strong></li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>Rs. {{ number_format($order->details->sum('total') ) }}</td>
                                        <td>
                                            <form action="{{ route('cms.orders.update', $order->id) }}" method="post" onchange="this.submit()">
                                                @method('PATCH')
                                                @csrf
                                                <select name="status" id="status" class="form-select" required>
                                                    <option value="Processing" {{ $order->status == 'Processing' ? 'selected' : '' }}>Processing</option>
                                                    <option value="Confirmed" {{ $order->status == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                                                    <option value="Shipping" {{ $order->status == 'Shipping' ? 'selected' : '' }}>Shipping</option>
                                                    <option value="Delivered" {{ $order->status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                                                    <option value="Cancelled" {{ $order->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                </select>
                                            </form>
                                        </td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ $order->updated_at }}</td>
                                        <td>
                                            <form action="{{route('cms.orders.destroy', $order->id)}}" method="post">
                                                @method('Delete')
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger btn-sm delete">
                                                    <i class="fa-solid fa-times me-2"></i>
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $orders->links() }}
                    @else
                        <h4 class="text-muted fst-italic">No data added.</h4>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection

@section('nav')
    @include('cms.includes.nav')
@endsection
