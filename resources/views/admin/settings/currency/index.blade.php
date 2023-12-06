@extends('admin.layout.app')

@section('title')
Currency Settings
@endsection



@section('content')
<div class="row w-100">
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Total Currencies</h5>
                    </div>
                </div>
                <h1 class="mt-1 mb-3">{{ $currencies->count() }}</h1>
            </div>
        </div>
    </div>
</div>
<div class="row clearfix w-100">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header pb-0 d-flex justify-content-end">
                {{-- <h2>All Currencies</h2> --}}
                <button data-toggle="modal" data-target="#newCurrency" class="btn btn-secondary btn-sm">New
                    Currency</button>
                @include('admin.settings.currency.create')
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Exchange Rate</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($currencies as $key => $currency)

                            <tr>
                                <td>{{ ++$key }}</td>
                                <td class="text-uppercase">{{ $currency->name }}</td>
                                <td>{{ $currency->code }}</td>
                                <td>{{ $currency->exchange_rate }}</td>
                                <td>
                                    @include('admin.settings.currency.edit')
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
