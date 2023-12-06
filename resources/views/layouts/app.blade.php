<!doctype html>
<html lang="en">

<head>
    <title>Amari | Simss & Stitches</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="Online Shopping, Online Fashion, fashion, fashion stores, sims and stiches">
    <meta name="description"
        content="Elevate your style with Simss & Stitches - where tradition meets elegant fashion in the heart of Africa.">
    <meta property="og:image" content="{{ secure_asset('images/favicon/android-chrome-512x512.png') }}" />
    <meta property="og:image:secure_url" content="{{ secure_asset('images/favicon/android-chrome-512x512.png') }}" />
    <meta property="og:image:type" content="image/png" />
    <meta name="google" content="nopagereadaloud" />
    <meta property="og:title" content="Simss And Stitches: The Perfect Place For African Fashion" />
    <meta property="og:type" content="website" />
    <meta name="twitter:card" content="summary_large_image" />

    <link rel="stylesheet" href="{{ secure_asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('css/bootstrap-side-modals.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('css/style.css') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ secure_asset('images/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ secure_asset('images/favicon/site.webmanifest') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        header.header {
            /* letter-spacing: 4px; */
        }

        header .top {
            letter-spacing: normal;
        }

        .mobile,
        .desktop {
            letter-spacing: normal;
        }

        .navbar-brand img {
            height: 60px;
        }

        @media (max-width: 600px) {
            .navbar-brand img {
                height: 50px;
            }
        }

        .dropdown:hover .dropdown-menu {
            display: block;
            margin-top: 5px;
        }

        span.bage {
            bottom: 10px;
            transition: all .3s ease-in-out;
        }

        .nav-item::after {
            content: '';
            display: block;
            width: 0;
            height: 2px;
            background: #000;
            transition: width .3s;
        }

        .nav-item:hover::after {
            width: 100%;
            // transition: width .3s;
        }
    </style>
    @yield('css')
</head>

<body>
    <div class="main">
        @if (Route::is('checkout.*') || Route::is('coming-soon'))

        @else
        <header class="header border-bottom">
            <div class="d-flex d-none align-items-center justify-content-end top py-2 bg-dark px-2 px-lg-5 px-md">
                {{-- <p class="mb-0 text-white text-decoration-underline d-no" style="cursor: pointer;"
                    data-bs-toggle="modal" data-bs-target="#size-chart">Size Chart</p> --}}
                @include('partials.size-chart')
                <div class="col-auto">
                    <select class="form-select form-select-sm rounded-0 bg-transparent currency text-white" name="currency"
                        id="currency">
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
                        @foreach ($currencies as $currency)
                        <option class="text-dark" {{ ($currency_code==$currency->code) ? 'selected' : '' }} value="{{
                            $currency->code
                            }}">{{ $currency->icon }} {{ $currency->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="">
                <nav class="navbar navbar-expand-lg py-3" style="background-color: #">
                    <div class="row gx-0 w-100 align-items-center">
                        <div class="col-2 col-md-2 text-start">
                            <button class="navbar-toggler d-lg-none" data-bs-toggle="modal"
                                data-bs-target="#mobileSideNav" type="button" aria-controls="collapsibleNavId"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 448 512">
                                    <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                    <path
                                        d="M0 96C0 78.33 14.33 64 32 64H416C433.7 64 448 78.33 448 96C448 113.7 433.7 128 416 128H32C14.33 128 0 113.7 0 96zM0 256C0 238.3 14.33 224 32 224H416C433.7 224 448 238.3 448 256C448 273.7 433.7 288 416 288H32C14.33 288 0 273.7 0 256zM416 448H32C14.33 448 0 433.7 0 416C0 398.3 14.33 384 32 384H416C433.7 384 448 398.3 448 416C448 433.7 433.7 448 416 448z" />
                                </svg>
                            </button>
                        </div>
                        <div class="col-8 col-md-8 text-center">
                            <a class="navbar-brand me-0" href="/">
                                <img src="{{ secure_asset('images/sss-logo.png') }}"
                                    class="d-inline-block align-text-top" alt="" srcset="">
                            </a>
                        </div>
                        <div class="col-2 col-md-2 text-end">
                            <div class="d-flex justify-content-end align-items-center mobile d-lg-none">
                                <i class="bi bi-search me-3" style="font-size: 20px"></i>
                                <div>
                                    <a data-bs-toggle="modal" data-bs-target="#modelId">
                                        <i class="bi bi-bag" style="font-size: 20px"></i>
                                        <span
                                            class="position-absolute bage start-100 translate-middle p-1 bg-dark border border-light rounded-circle {{ \Cart::session(App\Helpers\Helper::getSessionID())->getContent()->count() > 0 ? '' : 'd-none'}}"></span>
                                    </a>
                                </div>
                            </div>
                            <div class="desktop d-none d-lg-block">
                                <ul class="list-unstyled d-flex justify-content-end mb-0">
                                    <li><a href="{{ route('user') }}" class="text-decoration-none mx-3 text-uppercase"
                                            style="font-weight: 300">Account</a></li>
                                    <li><a href="{{ route('shop.cart') }}"
                                            class="text-decoration-none mx-3 text-uppercase"
                                            style="font-weight: 300">Cart ({{
                                            Cart::session(App\Helpers\Helper::getSessionID())->getContent()->count()
                                            }})</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>

                <nav class="navbar navbar-expand-lg bg-white d-none d-lg-block">
                    {{-- <a class="navbar-brand me-0" href="#">
                        SUBSCRIBE
                    </a> --}}
                    <div class="collapse navbar-collapse" id="navbarScroll">
                        <ul class="navbar-nav mx-auto my-2 my-lg-0 navbar-nav-scroll"
                            style="--bs-scroll-height: 100px;">
                            <li class="nav-item mx-4">
                                <a class="nav-link" aria-current="page" href="{{ route('home') }}">HOME</a>
                            </li>
                            @foreach (App\Models\Category::all() as $item)
                            <li class="nav-item mx-4">
                                <a class="nav-link text-uppercase" aria-current="page"
                                    href="{{ route('shop.category',$item->slug) }}">{{
                                    $item->name }}</a>
                            </li>

                            @endforeach


                            {{-- <li class="nav-item mx-4">
                                <a href="{{ route('custom') }}" class="nav-link">CUSTOM ORDER</a>
                            </li> --}}
                            {{-- <li class="nav-item mx-4">
                                <a href="{{ route('gallery') }}" class="nav-link">GALLERY</a>
                            </li> --}}
                            <li class="nav-item">
                                <a href="{{ route('contact') }}" class="nav-link">CONTACT</a>
                            </li>
                        </ul>
                        {{-- <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form> --}}
                    </div>
                </nav>
            </div>

        </header>



        <!-- Optional: Place to the bottom of scripts -->
        <script>
            const myModal = new bootstrap.Modal(document.getElementById('modalId'), options)

        </script>
        @include('partials.mobile-nav')
        @include('partials.cart-modal')
        @endif
        @if (Route::is('home'))
        {{-- @include('partials.shop-with-bm-modal') --}}
        @else

        @endif
        <div class="content">
            @yield('content')
        </div>
        @if (Route::is('checkout.*') || Route::is('coming-soon'))

        @else
        <div class="footer border-top">
            @include('layouts.footer')
        </div>
        @endif
    </div>
    @include('layouts.footer-scripts')
    <!-- Modal trigger button -->
    @yield('scripts')

</body>

</html>
