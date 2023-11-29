<nav class="navbar navbar-fixed-top">
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
</nav>
