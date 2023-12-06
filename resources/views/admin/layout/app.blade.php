<!doctype html>
<html lang="en">

<head>
    <title>Home</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="Amari | Sims & Stitches">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ secure_asset('admin/css/app.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    @yield('styles')
</head>



<body>
    <div class="wrapper">
        @include('admin.layout.sidebar')
        <div class="main">
            @include('admin.layout.header')
            <main class="content">
                @yield('content')
            </main>
        </div>
    </div>
    {{-- <div class="wrapper">
        @include('admin.layout.header')
        @include('admin.layout.sidebar')

        <div id="main-content">
            <div class="container-fluid">
                <div class="block-header">
                    <h2 class="float-start my-3"> @yield('title')</h2>
                    <p>@yield('description')</p>
                    <div class="row justify-content-center">

                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div> --}}


    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ secure_asset('admin/js/app.js') }}"></script>

    @yield('scripts')
</body>

</html>
