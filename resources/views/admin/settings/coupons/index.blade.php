@extends('admin.layout.app')

@section('content')
<div class="d-flex justify-content-end my-3">
    <button class="border-0 px-3 py-2 rounded-1 btn btn-sm btn-primary" data-bs-toggle="modal"
        data-bs-target="#createCoupon">New Coupon</button>
</div>
<div class="card">
    <div class="card-body">
        <table class="table" id="coupons">
            <thead>
                <tr>
                    <th scope="col">Code</th>
                    <th scope="col">Type</th>
                    <th scope="col">Value</th>
                    <th scope="col">Max. Usage</th>
                    <th scope="col">Start</th>
                    <th scope="col">End</th>
                    <th scope="col">Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($coupons as $key => $coupon)
                <tr class="">
                    <td>{{ $coupon->name }}</td>
                    <td>{{ $coupon->type }}</td>
                    <td>{{ $coupon->value }}%</td>
                    <td>{{ $coupon->maximum_usage }}</td>
                    <td>{{ \Carbon\Carbon::parse($coupon->starts_at)->format('F j, Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($coupon->ends_at)->format('F j, Y') }}</td>
                    <td>
                        <span class="badge rounded-pill bg-success">{{ $coupon->ends_at > \Carbon\Carbon::now() ?
                            'Active' :'Expired' }}</span>
                    </td>
                    <td>
                        <div class="d-flex">
                            <a data-bs-toggle="modal" data-bs-target="#editCoupon{{ $coupon->id }}"
                                class="btn btn-sm me-2 btn-info" href="">Edit </a>
                            <a class="btn btn-sm btn-danger"
                                href="{{ route('admin.settings.coupon.delete', $coupon->id) }}">Delete
                            </a>
                        </div>

                    </td>
                    @include('admin.settings.coupons.edit-coupon')
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@include('admin.settings.coupons.create-coupon')
@endsection
