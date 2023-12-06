@extends('layouts.app')

@section('css')
<style>
    * {
        text-transform: none;
        font-weight: normal;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"
    }

    .checkout-main {
        padding: 40px;

    }

    .form-control {
        border-radius: 0.3rem;
    }

    h5 {
        font-weight: 400;
    }

    span.badge {
        top: -5px;
        right: 10px;
        /* bottom: 10px; */
        transition: all .3s ease-in-out;
    }
    .breadcrumb {
        justify-content: center;
    }
    .form-control::placeholder {
        color: #837C7C;
        opacity: 1;
        font-size: 15px;
        font-weight: 400;
    }

    .product__description__variant {
        font-size: 13px;
    }

    @media only screen and (max-width: 595px) {
        .checkout-main {
            padding: 10px;
        }
        .wrapper {
            padding-left: 0px;
            padding-right: 0px;
            margin-left: 0px;
            margin-right: 0px;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid ">
    <div class="row" style="min-height: 100vh">
        <div class="col-lg-7 border-end">
            <div class="checkout-main">
                <div class="col-lg-1"></div>
                <div class="col-lg-11 col-12">
                    <div class="main ps-0 ms-0 ps-md-5 ms-md-5 ps-lg-5">
                        <div class="header text-center">
                            <img src="{{ secure_asset('images/sss-logo.png') }}" class="img-fluid" style="height: 40px;" alt="">
                            <nav aria-label="breadcrumb" class="pb-4 text-center">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item " aria-current="page"><a
                                            class="text-decoration-none text-muted" href="#"><small>Cart</small></a>
                                    </li>
                                    <li class="breadcrumb-item active"><a class="text-decoration-none"
                                            href="#"><small>Information</small></a></li>
                                    <li class="breadcrumb-item text-muted"><small>Shipping</small></li>
                                    <li class="breadcrumb-item  text-muted"><small>Payment</small></li>
                                </ol>
                            </nav>
                        </div>
                        <div class="body py-3">
                            <div class="mb-4 d-md-block d-lg-none">
                                @include('partials.cart-accordion')
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="mb-4">Contact Information</h5>
                                @if (!Auth::check())
                                {{-- <small>Have an account already? <a href="{{ route('login') }}">Log in</a></small> --}}
                                @endif
                            </div>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <form action="{{ route('checkout.page-1.store') }}" method="POST" class=" pb-5">
                                @csrf
                                @if (Auth::check())
                                <div class="card-body mb-3 ps-0">
                                    <h6>{{ Auth::user()->fname }} {{ Auth::user()->lname }}
                                        ({{ Auth::user()->email }})</h6>
                                    <input type="hidden" value="{{ Auth::user()->email }}" name="shipping_email">
                                    <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><small class="text-dark">Logout</small></a>

                                </div>
                                @else
                                <div class="mb-5">
                                    <input type="email" name="shipping_email" class="form-control"
                                        placeholder="Contact Information" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                    <div id="emailHelp" class="form-text">We'll never share your email with
                                        anyone
                                        else.</div>
                                </div>
                                @endif
                                <div class="shipping-information">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="mb-4">Shipping Address</h5>
                                        {{-- @if ($default->count() > 0)
                                            <a href="" data-bs-toggle="modal" data-bs-target="#editAddress">Edit</a>
                                            @include('partials.edit-default-address')
                                        @endif --}}
                                    </div>
                                    @if ($address)
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Default Address</h5>
                                            <p class="card-text mb-1">{{ $address->shipping_address }}, {{ $address->shipping_city }}, {{ $address->shipping_zipcode }} {{ $address->shipping_state }}, {{ $address->shipping_country }}</p>
                                            <p class="mb-0">{{ $address->shipping_phone }}</p>
                                        </div>
                                    </div>
                                    @else
                                    <div class="mb-3">
                                        <!-- <small class="text-muted">Country/Region</small> -->
                                        <select class="form-select" name="shipping_country" id="country" required>
                                            <option value="Nigeria">Nigeria</option>
                                            <option value="United Kingdom">United Kingdom</option>
                                            <option value="United States">United States</option>
                                        </select>
                                    </div>
                                    <div class="row g-2 mb-3">
                                        <div class="col">
                                            <!-- <small class="text-muted">First Name</small> -->
                                            <input type="text" name="shipping_fname"
                                                class="form-control" required placeholder="First name"
                                                aria-label="First name">
                                        </div>
                                        <div class="col">
                                            <!-- <small class="text-muted">Last Name</small> -->
                                            <input type="text" name="shipping_lname"
                                                class="form-control" required placeholder="Last name"
                                                aria-label="Last name">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <!-- <label for="exampleInputEmail1" class="form-label">Address</label> -->
                                        <input type="address" name="shipping_address" placeholder="Address" required
                                            class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp">
                                    </div>
                                    <div class="row g-2 mb-3">
                                        <div class="col-4">
                                            <input type="text" name="shipping_city" class="form-control"
                                                required placeholder="City/Town" aria-label="City">
                                        </div>

                                        <div class="col-4">
                                            <input type="text" name="shipping_state" class="form-control"
                                                required placeholder="Province/State" aria-label="State">
                                        </div>

                                        <div class="col-4">
                                            <!-- <small class="text-muted">Postal Code</small> -->
                                            <input type="text" name="shipping_postal_code"
                                                class="form-control" required placeholder="Postcode"
                                                aria-label="Postal Code">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <!-- <label for="exampleInputEmail1" class="form-label">Contact Information</label> -->
                                        <input type="text" name="shipping_phone" placeholder="Phone Number" required
                                            class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp">
                                    </div>
                                    @endif
                                </div>
                                <div class="d-flex justify-content-between align-items-center pt-3">
                                    <a href="{{ route('shop.cart') }}" class="text-decoration-none"><i
                                            class="fa fa-angle-left" aria-hidden="true"></i> Return to cart</a>
                                    <button type="submit" class="btn btn-primary btn-dark py-3 px-3 fw-normal">Continue
                                        to
                                        shipping</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 bg-light  d-sm-none d-md-block border-start ps-4 pt-5 d-sm-block d-none">
            @include('partials.fullpage-cart_details')
        </div>
    </div>
</div>
@endsection

