{{-- <nav class="navbar navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-btn">
            <button type="button" class="btn-toggle-offcanvas"><i class="lnr lnr-menu fa fa-bars"></i></button>
        </div>
        <div class="navbar-brand py-2">
            <a href="{{ route('admin.dashboard') }}"><img src="{{ secure_asset('images/sss-logo.png') }}" alt="Logo"
                    class="img-responsive logo"></a>
        </div>
        <div class="navbar-right">
            <div id="navbar-menu">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="icon-menu"><i class="icon-login"></i></a>
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav> --}}


<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                    <span class="text-dark">Administrator</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    {{-- <a class="dropdown-item" href="index.html"><i class="align-middle me-1"
                            data-feather="settings"></i>
                        Settings </a> --}}
                    {{-- <div class="dropdown-divider"></div> --}}
                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log out</a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                        @csrf
                        </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
