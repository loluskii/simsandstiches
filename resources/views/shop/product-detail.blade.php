@extends('layouts.app')

@section('css')
<style>
    .container {
        padding-top: 75px;
        padding-bottom: 75px;
    }

    @media (max-width:578px) {
        .main-content {
            padding-bottom: 75px;
        }
    }

    .thumbnail {
        /* background-color: #cccccc; */
        height: 145px;
        width: auto;
        background-position: center;
        background-repeat: no-repeat;
        background-size: contain;
        position: relative;
        padding: 60px;
    }

    #product-image {
        height: 600px;
        width: 500px;
        background-color: #cccccc;
        object-fit: cover;
    }


    .cat {
        margin: 4px;
        background-color: transparent;
        color: #BBBBBB;
        overflow: hidden;
        float: left;
        border: 1px solid #BBBBBB;
    }

    .cat label {
        float: left;
        min-width: 51px;
        height: 100%;

    }

    .cat label span {
        text-align: center;
        padding: 5px 15px;
        display: block;
        align-items: center;
        height: 100%;
        color: #bbb;
        font-weight: 500;
    }

    .cat label input {
        position: absolute;
        display: none;
        color: #fff !important;
    }


    .cat input:checked+span {
        color: #121212;
        border: 1px solid #121212;
    }

    #button-addon1 {
        border-top: 1px solid #ced4da;
        border-left: 1px solid #ced4da;
        border-bottom: 1px solid #ced4da;
    }

    #button-addon2 {
        border-top: 1px solid #ced4da;
        border-right: 1px solid #ced4da;
        border-bottom: 1px solid #ced4da;
    }

    li.nav-item .nav-link.active {
        color: #121212;
        background-color: transparent;
        /* border-bottom: 2px solid #121212; */
        font-weight: 600;
    }

    .product_image {
        background-color: #cccccc;
        height: 400px;
        width: auto;
        background-position: center -50px;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="border-0 mb-5">
        <div class="row main-content justify-content-center">
            <aside class="col-md-5 text-center pb-3 pb-md-3 pb-lg-3 pb-xl-3">
                <div class="row">

                    <div class="col-lg-9 col-md-9 col-sm-12 product-image">
                        <img src="{{ $product->images()->first()->url ?? '' }}" id="product-image" style=""
                            class="primary img-fluid">
                        {{-- <div class="prodcut-image"></div> --}}
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 ">
                        <div
                            class="img-small-wrap d-flex justify-content-between align-items-center flex-lg-column flex-md-column flex-sm-row order-lg-1 mt-lg-0 mt-md-0 mt-3">
                            @foreach ($product->images->take(3) as $image)
                            <div class="item-gallery d-flex align-items-center ">
                                <a href="#" class="thumbnail mb-3" data-big="{{ $image->url ?? '' }}"
                                    style="background-image: url('{{ $image->url ?? '' }}')"></a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </aside>
            <aside class="col-md-5">
                <article class="card-body p-sm-2 py-0">
                    <header
                        class="d-flex flex-lg-column flex-md-column flex-column align-items-lg-start align-items-md-start">
                        <p class=" text-decoration-underline" style="cursor: pointer;" data-bs-toggle="modal"
                            data-bs-target="#size-chart">Size Chart <i class="fa-solid fa-ruler"></i></p>
                        <h4 class="text-uppercase me-md-auto me-lg-auto me-xl-auto fw-bold">{{ $product->name }}</h4>
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
                        <p class="price-detail-wrap">
                            <span class="price h6" style="font-weight: 500">
                                <span class="num font-weight-bold">{{ $currency_symbol }}{{
                                    number_format(App\Helpers\Helper::currency_converter($product->price), 2) }}</span>
                            </span>
                        </p>
                    </header>
                    <form id="addToCart" class="pt-2 pt-md-4 pt-lg-4 pt-xl-4"
                        action="{{ route('cart.add',$product->id) }}" method="post">
                        @csrf

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-9">
                                @foreach ($group as $key => $item)
                                <div class="row">
                                    <div class="col-3">
                                        <label for="{{ $key }}" class="col-form-label text-uppercase">{{ $key }}</label>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <select class="form-select rounded-0" name="{{ $key }}" id="">
                                                <option>Select one</option>
                                                @foreach ($item as $value)
                                                <option value="{{ $value->value }}">{{ $value->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <div class="row gx-3 align-items-center mb-3">
                                    <div class="col-3">
                                        <label for="inputPassword6"
                                            class="col-form-label text-uppercase">QUANTITY</label>
                                    </div>
                                    <div class="col">
                                        <div class="input-group">
                                            <button class="btn px-2 btn-sm rounded-0 minus fw-bold" style="color: #bbb"
                                                type="button" id="button-addon1">-</button>
                                            <input type="text" value="1" name="quantity" readonly
                                                class="bg-white form-control text-center border-start-0 border-end-0"
                                                aria-label="Amount (to the nearest dollar)">
                                            <button class="btn btn-sm px-2 plus rounded-0 fw-bold" style="color: #bbb"
                                                type="button" id="button-addon2">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-block btn-dark rounded-0 w-100 mb-3 px-5">ADD TO
                            CART</button>
                    </form>
                </article>
            </aside>
        </div>

    </div>
</div>
@if ($similar->count() > 0)
<div class="container border-top">
    <div class="pt-3">
        <div class="text-center pb-5">
            <h4>YOU MAY LIKE THESE</h4>
        </div>
        <div class="row justify-content-center">
            @foreach ($similar as $product)
            <div class="col-md-3 mb-3">
                <a class=" text-decoration-none" href="{{ route('shop.product.show',$product->slug) }}">
                    <div class="card rounded-0 border-0">
                        <div class="product_image"
                            style="background-image: url('{{ $product->images()->first()->url ?? '' }}')"></div>
                        <div class="card-body text-center text-decoration-none">
                            <h5 class="card-title text-uppercase  text-decoration-none">{{ $product->name }}</h5>
                            <p class="card-text ">{{ $currency_symbol }}{{
                                number_format(App\Helpers\Helper::currency_converter($product->price), 2) }}</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach

        </div>
    </div>
</div>
@endif
@endsection

@section('scripts')
<script>
    $(document).ready(function (){
        $('.minus').click(function () {
            var $input = $(this).parent().find('input');
            var count = parseInt($input.val()) - 1;
            count = count < 1 ? 1 : count;
            $input.val(count);
            $input.change();
            return false;
        });
        $('.plus').click(function () {
            var $input = $(this).parent().find('input');
            $input.val(parseInt($input.val()) + 1);
            $input.change();
            return false;
        });
        $("#buyNow").on("click", function () {
            $('#addToCart').append("<input type='hidden' name='buy_now' value='true'/>");
        });
        $('.thumbnail').on('click', function(e) {
            console.log('clicked');
            var clicked = $(this);
            var newSelection = clicked.data('big');
            console.log(newSelection);
            var $img = $('.primary').attr("src", newSelection);
            // clicked.parent().find('.thumbnail').removeClass('selected');
            // clicked.addClass('selected');
            $('.primary').empty().append($img.hide().fadeIn());

        });
    })
</script>
@endsection
