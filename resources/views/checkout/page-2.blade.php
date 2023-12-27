@extends('layouts.app')

@section('css')
<style>
    * {
        text-transform: none;
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
        font-weight: 500px;
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

    .shipping-method-container {
        max-height: 500px;
        overflow-y: auto;
    }


    /* width */
    .shipping-method-container::-webkit-scrollbar {
        width: 5px;
    }

    /* Track */
    .shipping-method-container::-webkit-scrollbar-track {
        box-shadow: inset 0 0 5px rgb(213, 213, 213);
        /* border-radius: 10px; */
    }

    /* Handle */
    .shipping-method-container::-webkit-scrollbar-thumb {
        background: rgb(218, 218, 218);
        /* border-radius: 10px; */
    }
</style>
@endsection

@section('content')
<div class="container-fluid ">
    <div class="row min-vh-100">
        <div class="col-md-7 border-end">
            <div class="checkout-main">
                <div class="col-md-1"></div>
                <div class="col-md-11 col-12">
                    <div class="main ps-0 ms-0 ps-md-5 ms-md-5 ps-lg-5">
                        <div class="header text-center">
                            <img src="{{ secure_asset('images/sss-logo.png') }}" class="img-fluid" style="height: 40px;"
                                alt="">
                            <nav aria-label="breadcrumb" class="pb-4 text-center">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item " aria-current="page"><a
                                            class="text-decoration-none text-muted" href="#"><small>Cart</small></a>
                                    </li>
                                    <li class="breadcrumb-item"><a class="text-decoration-none text-muted"
                                            href="#"><small>Information</small></a></li>
                                    <li class="breadcrumb-item active text-dark"><small>Shipping</small></li>
                                    <li class="breadcrumb-item  text-muted"><small>Payment</small></li>
                                </ol>
                            </nav>
                        </div>
                        <div class="body py-3">
                            <div class="mb-4 d-sm-block d-md-none d-lg-none">
                                @include('partials.cart-accordion')
                            </div>
                            <div class="card mb-5">
                                <div class="card-body">
                                    <div class="contact">
                                        <div class="row">
                                            <div class="col-auto col-md-2">
                                                <span class="text-muted">Contact</span>
                                            </div>
                                            <div class="col-auto col-md-10">
                                                <span class=" text-wrap">{{ $order->shipping_email }}</span>
                                            </div>
                                        </div>
                                        {{-- <a href="" class="text-decoration-none"><small
                                                style=" font-weight: 500">Change</small></a> --}}
                                    </div>
                                    <hr style="width: auto">
                                    <div class="shipping">
                                        <div class="row h-100">
                                            <div class="col-auto col-md-2">
                                                <span class="text-muted">Ships to</span>
                                            </div>
                                            <div class="col-auto col-md-10 h-100">
                                                <span class="text-wrap">{{ $order->shipping_address }}, {{
                                                    $order->shipping_zipcode }} {{ $order->shipping_state }},{{
                                                    $order->shipping_country }}</span>
                                            </div>
                                        </div>
                                        {{-- <a href="" class="text-decoration-none"><small
                                                style=" font-weight: 500">Change</small></a> --}}
                                    </div>
                                </div>
                            </div>
                            @php
                            $currencies = App\Models\Currency::where('status','active')->get();
                            App\Helpers\Helper::currency_load();
                            $currency_code = session('currency_code');
                            $currency_symbol = session('currency_symbol');
                            if($currency_symbol == ""){
                            $system_default_currency_info = session('system_default_currency_info');
                            $currency_symbol = $system_default_currency_info->symbol;
                            $currency_code = $system_default_currency_info->code;
                            }
                            @endphp
                            <form action="{{ route('checkout.page-2.store') }}" method="POST" class="pb-5">
                                @csrf
                                <input type="hidden" name="subtotal"
                                    value="{{ \Cart::session(App\Helpers\Helper::getSessionID())->getSubTotal() }}">
                                <input type="hidden" name="grand_total"
                                    value="{{ \Cart::session(App\Helpers\Helper::getSessionID())->getTotal() }}">

                                <div class="shipping-information">
                                    <h4 style="font-weight: normal" class="mb-4">Shipping Method</h4>

                                    @php
                                    $condition = Cart::getCondition('Express Shipping');
                                    $attributes = $condition ? $condition->getAttributes() : null
                                    @endphp

                                    <div class="shipping-method-container" style="">
                                        @foreach ($shippings as $key => $location)
                                        <label
                                            class="card p-3 checkbox-label d-flex w-100 rounded-0 {{ $key == 0 ? 'rounded-top': '' }} {{ $key == $shippings->count() - 1 ? 'rounded-bottom': 'border-bottom-0' }}"
                                            id="planbox">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex w-100 justify-content-start align-items-center">
                                                    <input type="radio"
                                                        class="form-check-input me-4 mt-0 shipping-location"
                                                        value="{{ $location->id }}" name="shipping" {{ $attributes &&
                                                        $attributes['id']===$location->id ? 'checked' : '' }}>

                                                    <div
                                                        class="d-flex w-100 justify-content-between align-items-center">
                                                        <div>
                                                            <h5 class="h6 mb-0">{{ $location->group_name }}</h5>
                                                            <p class="text-muted small mb-0">{{
                                                                $location->group_locations }}</p>
                                                        </div>
                                                        <span>{{ $currency_symbol }}{{
                                                            number_format(App\Helpers\Helper::currency_converter($location->price),
                                                            2)
                                                            }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center pt-3">
                                    <a href="{{ route('checkout.page-1',$session) }}" class="text-decoration-none"><i
                                            class="fa fa-angle-left me-3" aria-hidden="true"></i> Return to
                                        information</a>
                                    <button type="submit" class="btn btn-primary btn-dark py-3 px-3"
                                        style="font-weight: 400">Continue to
                                        Payment</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5 bg-light  d-sm-none d-md-block border-start ps-4 pt-5 d-sm-block d-none">
            @include('partials.fullpage-cart_details')
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $('input[name=shipping]').on('change',function (){
        var id = $(this).val();
        console.log(id)

        $.ajax({
            type: 'POST',
            url: `{{ route('shipping.update') }}`,
            data: {
                _token: '{{ csrf_token() }}',
                id: id
            },
            success: function (response){
                location.reload()
            }
        })
    });
    $('.getDiscount').on('click', function (e){
        e.preventDefault()
        console.log(e)
        e.target.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
        var coupon = $('input[name=coupon]').val();
        $.ajax({
            type: 'POST',
            url: `{{ route('shipping.discount') }}`,
            data: {
                _token: '{{ csrf_token() }}',
                coupon_code: coupon
            },
            success: function (response){
                window.location.reload()
            },
            error: function (response) {
                e.target.innerHTML = 'Apply'
                alert(response.responseJSON.message)
            }
        })
    })
</script>
@endsection
