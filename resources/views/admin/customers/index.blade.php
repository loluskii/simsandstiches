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
                        <h5 class="card-title">Total Users</h5>
                    </div>
                </div>
                <h1 class="mt-1 mb-3">{{ $users->count() }}</h1>
            </div>
        </div>
    </div>
</div>

<div class="row clearfix w-100">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th style="width:60px;">#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>No. of Orders</th>
                                <th>Member Since</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $user)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $user->fname }} {{ $user->lname }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->getOrders()->count() }}</td>
                                <td>{{ $user->created_at->diffForHumans() }}</td>
                                <td>
                                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                        data-bs-placement="top" aria-label="Remove">
                                        <a class="text-info d-inline-block remove-item-btn" data-bs-toggle="modal"
                                            href="#editUserModal{{ $user->id }}">
                                            Edit
                                        </a>
                                    </li>
                                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                        data-bs-placement="top" aria-label="Remove">
                                        <a class="text-danger d-inline-block remove-item-btn" data-bs-toggle="modal"
                                            href="#deleteRecordModal{{ $user->id }}">
                                            Delete
                                        </a>
                                    </li>
                                </td>
                            </tr>
                            <div class="modal fade zoomIn" id="deleteRecordModal{{ $user->id }}" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-sm">
                                    <div class="modal-content">

                                        <div class="modal-body">
                                            <div class="mt-2 text-center">
                                                <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                                    colors="primary:#f7b84b,secondary:#f06548"
                                                    style="width:100px;height:100px">
                                                </lord-icon>
                                                <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                                    <h4>Are you sure ?</h4>
                                                    <p class="text-muted mx-4 mb-0">Are you sure you want to remove this
                                                        record ?
                                                    </p>
                                                </div>
                                            </div>
                                            <form method="post" action="{{ route('admin.users.delete', $user->id) }}">
                                                @csrf
                                                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                                    <button type="button" class="btn w-sm btn-light"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn w-sm btn-danger"
                                                        id="delete-record">Yes, Delete
                                                        It!</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade zoomIn" id="editUserModal{{ $user->id }}" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">

                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('admin.user.update', ['id' => $user->id]) }}">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-2">
                                                            <label for="" class="form-label"></label>
                                                            <input type="text" required name="fname" id=""
                                                                class="form-control form-control-lg"
                                                                placeholder="First Name" value="{{ $user->fname }}"
                                                                aria-describedby="helpId">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-2">
                                                            <label for="" class="form-label"></label>
                                                            <input type="text" value="{{ $user->lname }}" required
                                                                name="lname" id="" class="form-control form-control-lg"
                                                                placeholder="Last Name" aria-describedby="helpId">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-2">
                                                            <label for="" class="form-label"></label>
                                                            <input type="text" value="{{ $user->email }}" required
                                                                name="email" id="" class="form-control form-control-lg"
                                                                placeholder="Email" aria-describedby="helpId">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-2">
                                                            <label for="" class="form-label"></label>
                                                            <input type="tel" value="{{ $user->phone_no }}" required
                                                                name="phone_no" id=""
                                                                class="form-control form-control-lg"
                                                                placeholder="Phone Number" aria-describedby="helpId">
                                                        </div>
                                                  </div>
                                                                                                                                 
                                                </div>

                                                <div class="d-grid gap-2">
                                                    <button type="submit" name="" id=""
                                                        class="rounded-0 btn btn-primary text-uppercase">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
