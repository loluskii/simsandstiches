@extends('admin.layout.app')

@section('title')
Dashboard
@endsection



@section('content')
<div class="row clearfix w-100">
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Sales This Week</h5>
                    </div>
                </div>
                <h1 class="mt-1 mb-3">{{ number_format($sales, 2) }}</h1>
                <div class="mb-0 d-none">
                    <span class="badge badge-success-light"> <i class="mdi mdi-arrow-bottom-right"></i> 3.65% </span>
                    <span class="text-muted">Since last week</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Orders This Week</h5>
                    </div>
                </div>
                <h1 class="mt-1 mb-3">{{ number_format($sales, 2) }}</h1>
                <div class="mb-0 d-none">
                    <span class="badge badge-success-light"> <i class="mdi mdi-arrow-bottom-right"></i> 3.65% </span>
                    <span class="text-muted">Since last week</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Total Orders</h5>
                    </div>
                </div>
                <h1 class="mt-1 mb-3">{{ $orders }}</h1>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Total Users</h5>
                    </div>
                </div>
                <h1 class="mt-1 mb-3">{{ $users }}</h1>
            </div>
        </div>
    </div>
</div>

<div class="row clearfix w-100">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="header">
                    <h2 class="card-title">Recent Orders</h2>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th style="width:60px;">#</th>
                                <th>Order ID</th>
                                <th>Email</th>
                                <th>Method</th>
                                <th>Total</th>
                                <th>Currency</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($recent_orders->count() > 0)
                            @foreach ($recent_orders as $key => $order)
                            @php
                            if($order->status == 1){
                            $color = 'success';
                            $status = 'Payment Confirmed';
                            }elseif ($order->status == 2) {
                            $color = 'success';
                            $status = 'Awaiting Pickup';
                            }elseif ($order->status == 3) {
                            $color = 'success';
                            $status = 'Shipping in Progress';
                            }elseif ($order->status == 5) {
                            $color = 'success';
                            $status = 'Delivered';
                            }elseif ($order->status == 6) {
                            $color = 'danger';
                            $status = 'Cancelled';
                            }else {
                            $color = 'bg-secondary';
                            $status = 'Unknown';
                            }
                            @endphp
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td class="text-truncate">{{ $order->order_reference }}</td>
                                <td>{{ $order->shipping_email }}</td>
                                <td>{{ $order->payment_method }}</td>
                                <td>{{ number_format($order->subtotal, 2) }}</td>
                                <td>{{ $order->order_currency }}</td>
                                <td class="text-nowrap">{{ $order->created_at->diffForHumans() }}</td>
                                <td><span class="badge bg-{{ $color ?? 'success' }}">{{ $status }}</span></td>
                                <td><a href="{{ route('admin.orders.show', $order->order_reference) }}"
                                        class="btn btn-info btn-sm">View</a></td>
                            </tr>
                            @endforeach
                            @else
                            <tr class="text-center">
                                <td colspan="9">No Recent Orders</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="d-none row clearfix w-100">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Recent Customers</h2>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th style="width:60px;">#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Country</th>
                                <th>Member Since</th>
                                {{-- <th>Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recent_users as $key => $user)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $user->fname }} {{ $user->lname }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->getCountry() ?? 'Not Available' }}</td>
                                <td>{{ $user->created_at->diffForHumans() }}</td>
                                {{-- <td><button class="btn btn-info btn-sm">View</button></td> --}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
