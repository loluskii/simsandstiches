
@extends('admin.layout.app')

@section('title')
    Shipping Settings
@endsection

@section('description')
Set shipping rates for orders
@endsection



@section('content')
<div class="row clearfix w-100">
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Total Groups</h5>
                    </div>
                </div>
                <h1 class="mt-1 mb-3">{{ $shipping->count() }}</h1>
            </div>
        </div>
    </div>
</div>
<div class="row clearfix w-100">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-end pb-0">
                {{-- <h2>All shipping</h2> --}}
                <button data-bs-toggle="modal" data-bs-target="#newShippingGroup" class="btn btn-secondary btn-sm">New Group</button>
                @include('admin.settings.shipping.create')
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Locations</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shipping as $key => $value)

                            <tr>
                                <td>{{ ++$key }}</td>
                                <td class="text-uppercase">{{ $value->group_name }}</td>
                                <td>{{ $value->group_locations }}</td>
                                <td>{{ $value->price }}</td>
                                <td>
                                    @include('admin.settings.shipping.edit')
                                </td>
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
