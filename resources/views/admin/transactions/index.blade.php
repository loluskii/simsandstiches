@extends('admin.layout.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="h-100">
                <div class="row">
                    <div class="col-xl-4 col-md-6">
                        <!-- card -->
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Total Amount</h5>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">{{ number_format($total, 2) }}</h1>
                            </div>
                        </div>
                    </div><!-- end col -->
                    <div class="col-xl-4 col-md-6">
                        <!-- card -->
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Total Count</h5>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">{{ $transactions->count() }}</h1>
                            </div>
                        </div>
                    </div><!-- end col -->
                </div> <!-- end row-->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Transactions</h5>
                            </div>
                            <div class="card-body">
                                <table id="scroll-vertical"
                                    class="table table-bordered dt-responsive nowrap align-middle mdl-data-table"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Transaction ID</th>
                                            <th>Transaction Date</th>
                                            <th>Transaction amount</th>
                                            <th>Order ID</th>
                                            <th>Currency</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($transactions->count() > 0)
                                        @foreach ($transactions as $key => $transaction)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td class="text-uppercase">{{ $transaction->payment_ref }}</td>
                                            <td>{{ $transaction->created_at ?? '' }}</td>
                                            <td>N{{ number_format($transaction->amount, 2) }}</td>
                                            <td class="text-uppercase">{{ $transaction->order->order_number ?? '' }}
                                            </td>
                                            <td>{{ $transaction->currency }}</td>
                                            {{-- <td></td> --}}
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="6" class="text-center">No Data</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- end .h-100-->

        </div> <!-- end col -->
    </div>

</div>
@endsection
