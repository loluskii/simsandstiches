@extends('layouts.app')


@section('css')
<style>
    .main-header {
        /* Remove background-image property */
        background-color: #cccccc;
        height: 650px;
        position: relative;
        padding: 60px;
        overflow: hidden;
        /* Ensure the video stays within the container */
    }

    /* .header-text {
        position: absolute;
        top: 50%;
        Adjust as needed
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        text-transform: uppercase;
        width: 600px;
        text-align: center;
        Center the text
    }

    .header-text h3 {
        font-weight: bolder;
        font-size: 45px;
        line-height: 68px;
    } */

    /* Add the video element */
    .header-video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* z-index: -1; */
        /* Ensure the video stays behind other content */
    }

    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        /* Adjust the color and opacity */
    }

    .jumbotron {
        background-image: url("{{ secure_asset('images/simiExports-33 (1).jpg') }}");
        background-color: #cccccc;
        /* height: 700px; */
        background-position: center 33%;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
        padding: 60px;
        border-radius: 0;
    }

    .header-text {
        position: absolute;
        top: 55%;
        color: white;
        text-transform: uppercase;
        width: 600px;
    }

    .header-text h3 {
        font-weight: bolder;
        font-size: 45px;
        line-height: 68px;
    }

    .product-image {
        background-color: #cccccc;
        height: 400px;
        width: auto;
        background-position: center -50px;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
    }

    @media (max-width: 576px) {
        .main-header {
            height: calc(100vh - 220px);
            padding: 30px;
        }

        .header-text {
            position: absolute;
            top: 75%;
            color: white;
            text-transform: uppercase;
            width: 350px;
            text-align: center
        }

        .header-text h3 {
            font-weight: bolder;
            font-size: 25px;
            line-height: normal;
        }

        .product-image {
            background-position: center 1px;
            height: 250px;
        }
    }

    @media (min-width: 320px) and (max-width: 576px) {
        .header-text h3 {
            font-weight: bolder;
            font-size: 20px;
            line-height: normal;
        }

        .header-text {
            position: absolute;
            top: 70%;
            color: white;
            text-transform: uppercase;
            width: auto;
            text-align: center;
        }
    }
</style>
@endsection

@section('content')
<div class="container container-md container-lg">
    <div class="main-header mt-5">
        <!-- Add the video element -->
        <video class="header-video" autoplay muted loop>
            <source src="{{ secure_asset('SIMI CLIP NW 1.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <!-- Add an overlay div for the tint -->
        <div class="overlay"></div>
        <div class="header-text">
            <h3>discover african elegance here</h3>
            <a class="btn btn-dark px-3" href="{{ route('shop') }}">SHOP NOW</a>
        </div>
    </div>
    <div class="section-1 py-5">
        <div class="text-center pb-5">
            <h5>NEW ARRIVALS</h5>
        </div>
        <div class="row justify-content-center">
            @if ($products->count() > 0)
            @foreach ($products as $product)
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
            <div class="col-sm-3 col-md-4 col-lg-3 col-6 mb-3">
                <a class=" text-decoration-none" href="{{ route('shop.product.show',$product->slug) }}">
                    <div class="card rounded-0 border-0">
                        <div class="product-image"
                            style="background-image: url('{{ $product->images()->first()->url ?? '' }}')">
                        </div>
                        <div class="card-body text-center text-decoration-none">
                            <h6 class="card-title text-uppercase h6 text-decoration-none">{{ $product->name }}</h6>
                            <p class="card-text ">{{ $currency_symbol }}{{
                                number_format(App\Helpers\Helper::currency_converter($product->price), 2) }}</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
            <div class="d-flex justify-content-center text-center">
                <a href="{{ route('shop') }}" class="btn btn-dark rounded-0 btn-sm small p-2">VISIT STORE</a>
            </div>
            @else
            <p class="py-5">No Products Available</p>
            @endif
        </div>
    </div>
    <div class="p-5 mb-4 bg-light rounded-3 jumbotron" style="height: 400px">
        <div
            class="container-fluid col-sm-6 col-md-6 col-lg-4 col-xl-4 offset-8 fs-6 py-3 mt-3 mb-5 bg-light bg-opacity-50">
            <h3 class="text-capitalize">sustainable fashion</h3>
            <p class="">Conscious of our carbon footprint, we utilize several avenues to actualise sustainability using:
                natural dyes for our Adire, 100% cotton materials, and a slow fashion approach in producing our
                apparel.</p>
            <a class="btn btn-dark btn-sm" href="{{ route('about') }}">Learn more</a>
        </div>
    </div>
</div>
{{-- <div class="container py-5 d-none">
    <div class="row g-5">
        <div class="col-md-4">
            <div class="card position-relative">
                <img class="card-img-top" src="{{ secure_asset('images/pexels-destiawan-nur-agustra-1113554.jpg') }}"
                    alt="Title">
                <div class="card-body position-absolute bottom-0">
                    <h4 class="card-title">DRESSES</h4>
                    <p class="card-text">Text</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card position-relative">
                <img class="card-img-top" src="{{ secure_asset('images/pexels-gabriel-rodrigues-7050929.jpg') }}"
                    alt="Title">
                <div class="card-body text-white position-absolute bottom-0">
                    <h4 class="card-title">JUMPSUITS</h4>
                    <p class="card-text">Text</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card position-relative">
                <img class="card-img-top" src="{{ secure_asset('images/pexels-rodnae-productions-6192585.jpg') }}"
                    alt="Title">
                <div class="card-body  position-absolute bottom-0 text-white">
                    <h4 class="card-title">TOPS</h4>
                    <p class="card-text">Text</p>
                </div>
            </div>
        </div>

    </div>
</div> --}}
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
	var video = document.querySelector('.header-video');
	if(video){
		video.play();
	}
});
</script>
@endsection

