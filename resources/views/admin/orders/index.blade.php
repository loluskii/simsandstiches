@extends('admin.layout.app')

@section('title')
Orders
@endsection



@section('content')
<div class="row clearfix w-100">
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Total Orders</h5>
                    </div>
                </div>
                <h1 class="mt-1 mb-3">{{ $orders->count() }}</h1>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Pending Orders</h5>
                    </div>
                </div>
                <h1 class="mt-1 mb-3">{{ $pending->count() }}</h1>
            </div>
        </div>
    </div>
</div>
<div class="row clearfix w-100">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">All Orders</h2>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th style="width:60px;">#</th>
                                <th>Order ID</th>
                                <th>Email</th>
                                <th>Method</th>
                                <th>Total</th>
                                <th>Currency</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($orders->count() > 0)
                            @foreach ($orders as $key => $order)
                            @php
                            if($order->status == 1){
                            // $color == null;
                            $status = 'Payment Confirmed';
                            }elseif ($order->status == 2) {
                            // $color = null;
                            $status = 'Awaiting Pickup';
                            }elseif ($order->status == 3) {
                            // $color = null;
                            $status = 'Shipping in Progress';
                            }elseif ($order->status == 5) {
                            // $color = 'bg-success';
                            $status = 'Delivered';
                            }elseif ($order->status == 6) {
                            $color = 'bg-danger';
                            $status = 'Cancelled';
                            }else {
                            $color = 'bg-secondary';
                            $status = 'Unknown';
                            }
                            @endphp
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $order->order_reference }}</td>
                                <td>{{ $order->shipping_email }}</td>
                                <td>{{ $order->payment_method }}</td>
                                <td>{{ number_format($order->grand_total, 2) }}</td>
                                <td>{{ $order->order_currency }} </td>
                                <td><span class="badge bg-success">{{ $status }}</span></td>
                                <td><a href="{{ route('admin.orders.show', $order->order_reference) }}"
                                        class="btn btn-info btn-sm">View</a></td>
                            </tr>
                            @endforeach
                            @else
                            <tr class="text-center">
                                <td colspan="8">No Recent Orders</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
