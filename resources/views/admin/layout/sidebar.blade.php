{{-- <div id="left-sidebar" class="sidebar">
    <div class="">
        <div class="user-account">
            <hr>
        </div>
        <nav id="left-sidebar-nav" class="sidebar-nav">
            <ul id="main-menu" class="metismenu">
                <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class=""><i class="icon-home"></i>
                        <span>Dashboard</span></a>
                </li>
                <li class="{{ Route::is('admin.orders.*') ? 'active' : '' }}">
                    <a href="#" class="has-arrow"><i class="icon-grid"></i> <span>Sales</span></a>
                    <ul>
                        <li class="{{ Route::is('admin.orders.index') ? 'active' : '' }}"><a
                                href="{{ route('admin.orders.index') }}">Orders</a></li>
                        <li class="{{ Route::is('admin.orders.custom') ? 'active' : '' }}"><a
                                href="{{ route('admin.orders.custom') }}">Custom Orders</a></li>
                    </ul>
                </li>
                <li class="{{ Route::is('admin.category.*') ? 'active' : '' }}">
                    <a href="#" class="has-arrow"><i class="icon-folder"></i> <span>Catalog</span></a>
                    <ul>
                        <li><a href="{{ route('admin.products.index') }}">Products</a></li>
                        <li><a href="{{ route('admin.category.index') }}">Categories</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="has-arrow"><i class="icon-globe"></i> <span>Customers</span></a>
                    <ul>
                        <li><a href="{{ route('admin.user.index') }}">List</a></li>
                        <li><a href="blog-list.html">Newsletter Subscriptions</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="has-arrow"><i class="icon-diamond"></i> <span>Settings</span></a>
                    <ul>
                        <li><a href="ui-typography.html">Locales</a></li>
                        <li><a href="{{ route('admin.settings.currency.index') }}">Currency Settings</a></li>
                        <li><a href="{{ route('admin.settings.currency.index') }}">Shipping Settings</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div> --}}

<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ route('admin.dashboard') }}">
            <span class="align-middle">AdminKit</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Administrator
            </li>

            <li class="sidebar-item {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.dashboard') }}">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item {{ Route::is('admin.orders.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.orders.index') }}">
                    <i class="align-middle" data-feather="package"></i> <span class="align-middle">Orders</span>
                </a>
            </li>

            <li class="sidebar-item {{ Route::is('admin.products.index') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.products.index') }}">
                    <i class="align-middle" data-feather="folder"></i> <span class="align-middle">Products</span>
                </a>
            </li>

            <li class="sidebar-item {{ Route::is('admin.user.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.user.index') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Customers
                    </span>
                </a>
            </li>

            <li class="sidebar-item {{ Route::is('admin.transactions.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.transactions.index') }}">
                    <i class="align-middle" data-feather="credit-card"></i> <span class="align-middle">Transactions</span>
                </a>
            </li>
            <li class="sidebar-item {{ Route::is('admin.subscribers.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.subscribers.index') }}">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">Subscribers</span>
                </a>
            </li>

            <li class="sidebar-header">
               Site Settings
            </li>

            <li class="sidebar-item {{ Route::is('admin.settings.currency.index') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.settings.currency.index') }}">
                    <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Currencies</span>
                </a>
            </li>

            <li class="sidebar-item {{ Route::is('admin.settings.shipping.index') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.settings.shipping.index') }}">
                    <i class="align-middle" data-feather="truck"></i> <span class="align-middle">Shipping Rates</span>
                </a>
            </li>
            <li class="sidebar-item {{ Route::is('admin.settings.coupon.index') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.settings.coupon.index') }}">
                    <i class="align-middle" data-feather="truck"></i> <span class="align-middle">Coupons</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
