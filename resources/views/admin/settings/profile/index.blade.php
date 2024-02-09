@extends('admin.layout.app')

@section('page-title')
Profile
@endsection

@section('content')
<div class="row">
    <!--end col-->
    <div class="col-xxl-8 mx-auto">
        <div class="card">
            <div class="card-header border-bottom">
                <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab"
                            aria-selected="false" tabindex="-1">
                            Personal Details
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab" aria-selected="false"
                            tabindex="-1">
                            Change Password
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body p-4">
                <div class="tab-content">
                    <div class="tab-pane active" id="personalDetails" role="tabpanel">
                        <form method="POST" action="{{ route('admin.settings.profile.update') }}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="firstnameInput" class="form-label">First Name</label>
                                        <input type="text" name="fname" class="form-control" id="firstnameInput"
                                            placeholder="Enter your firstname" value="{{ $user->fname }}">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="lastnameInput" class="form-label">Last Name</label>
                                        <input type="text" name="lname" class="form-control" id="lastnameInput"
                                            placeholder="Enter your lastname" value="{{ $user->lname }}">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="phonenumberInput" class="form-label">Phone Number</label>
                                        <input type="text" name="phone_no" class="form-control" id="phonenumberInput"
                                            placeholder="Enter your phone number" value="{{ $user->phone_no }}">
                                    </div>
                                </div>
                                <!--end col-->
                                {{-- <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="emailInput" class="form-label">Email Address</label>
                                        <input type="email" name="email" class="form-control" id="emailInput"
                                            placeholder="Enter your email" value="{{ $user->email }}">
                                    </div>
                                </div> --}}

                            </div>
                            <div class="col-lg-12">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-success">Update Profile</button>
                                </div>
                            </div>
                            <!--end row-->
                        </form>
                    </div>
                    <div class="tab-pane" id="changePassword" role="tabpanel">
                        <form method="POST" action="{{ route('admin.settings.profile.update.password') }}">
                            @csrf
                            <div class="row g-2">
                                <div class="col-lg-4">
                                    <div>
                                        <label for="oldpasswordInput" class="form-label">Old Password*</label>
                                        <input type="password" name="current_password" class="form-control"
                                            id="oldpasswordInput" placeholder="Enter current password">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-4">
                                    <div>
                                        <label for="newpasswordInput" class="form-label">New Password*</label>
                                        <input type="password" name="new_password" class="form-control"
                                            id="newpasswordInput" placeholder="Enter new password">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-4">
                                    <div>
                                        <label for="confirmpasswordInput" class="form-label">Confirm Password*</label>
                                        <input type="password" name="confirm_new_password" class="form-control"
                                            id="confirmpasswordInput" placeholder="Confirm password">
                                    </div>
                                </div>
                                <!--end col-->
                                {{-- <div class="col-lg-12">
                                    <div class="mb-3">
                                        <a href="javascript:void(0);"
                                            class="link-primary text-decoration-underline">Forgot Password ?</a>
                                    </div>
                                </div> --}}
                                <!--end col-->
                                <div class="col-lg-12">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success">Change Password</button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end col-->
</div>
@endsection
