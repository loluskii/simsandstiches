<div id="left-sidebar" class="sidebar">
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
                        {{-- <li><a href="blog-list.html">Newsletter Subscriptions</a></li> --}}
                    </ul>
                </li>
                <li>
                    <a href="#" class="has-arrow"><i class="icon-diamond"></i> <span>Settings</span></a>
                    <ul>
                        {{-- <li><a href="ui-typography.html">Locales</a></li> --}}
                        <li><a href="{{ route('admin.settings.currency.index') }}">Currency Settings</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
