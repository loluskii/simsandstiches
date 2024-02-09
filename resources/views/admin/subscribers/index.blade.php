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
                        <h5 class="card-title">Total Subscribers</h5>
                    </div>
                </div>
                <h1 class="mt-1 mb-3">{{ $subscribers->count() }}</h1>
            </div>
        </div>
    </div>
</div>

<div class="row clearfix w-100">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th style="width:60px;">#</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($subscribers->count() > 0)
                            @foreach ($subscribers as $key => $user)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="2">No Data</td>
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
